<?php

namespace App\Http\Controllers;

use App\Enums\AUserType;
use App\Enums\DrinkStatus;
use App\Enums\DrinkTarget;
use App\Http\Requests\AddDrinkRequest;
use App\Http\Requests\AddUserRequest;
use App\Http\Requests\DeleteUserRequest;
use App\Http\Requests\OrderDrinkRequest;
use App\Http\Requests\UpdateDrinkRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Mail\SendAccountDataForNewUsers;
use App\Models\Drink;
use App\Models\EmployeeDrink;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Testing\Fluent\Concerns\Has;

class UserController extends Controller
{
    public function __construct()
    {
//        $this->getMiddleware(['auth']);
    }

    public function dashboard()
    {
        $drinksOrdered = EmployeeDrink::query()->where('user_id', auth()->id())->with('maker')->orderByDesc('created_at')->get();
        $drinks = Drink::all();
        return view('dashboard', ['drinks' => $drinks, 'drinksOrdered' => $drinksOrdered, 'number_of_drinks' => $this->convertNumbersToArabic(auth()->user()->number_of_drinks), 'number_of_drinks_ordered' => $this->convertNumbersToArabic(auth()->user()->number_of_drinks_ordered)]);
    }
    public function usersPage()
    {
        if (auth()->user()->type != AUserType::ADMIN )
            return redirect()->route('dashboard')->with('error', 'ليس لديك تفويض لاتخاذ هذا الإجراء.');

        $users = User::query()->paginate(10);
        return view('users', ['users' => $users]);
    }

    public function addUser(AddUserRequest $request)
    {
        if (auth()->user()->type != AUserType::ADMIN )
            return redirect()->route('dashboard')->with('error', 'ليس لديك تفويض لاتخاذ هذا الإجراء.');

        $data = $request->validated();
        $password = $data['password'];
        $data['password'] = Hash::make($password);
        $user = User::query()->create($data);
        try {
            Mail::to($user)->send(new SendAccountDataForNewUsers($user, $password));
        } catch (\Exception $e) {
            User::destroy([$user->id]);
            return back()->with('error', 'لم يتم إرسال البريد الإلكتروني للمستخدم.');
        }
        return back()->with('success', 'تم اضافه المستخدم بنجاح.');
    }

    public function deleteUser($id)
    {
        if (auth()->user()->type != AUserType::ADMIN )
            return redirect()->route('dashboard')->with('error', 'ليس لديك تفويض لاتخاذ هذا الإجراء.');

        User::destroy([$id]);
        return back()->with('success', 'تم حذف المستخدم بنجاح.');
    }

    public function updateUserPage($id)
    {
        if (auth()->user()->type != AUserType::ADMIN )
            return redirect()->route('dashboard')->with('error', 'ليس لديك تفويض لاتخاذ هذا الإجراء.');
        return view('edit-user', ['user' => User::find($id)]);
    }

    public function updateUser(UpdateUserRequest $request)
    {
        $data = $request->validated();
        if (auth()->user()->type != AUserType::ADMIN )
            return redirect()->route('dashboard')->with('error', 'ليس لديك تفويض لاتخاذ هذا الإجراء.');

        if (isset($data['password']) && $data['password'])
            $data['password'] = Hash::make($data['password']);

        User::query()->find($data['id'])->update($data);
        User::query()->find($data['id'])->update(['phone_number' => $data['phone_number']]);
        if (auth()->user()->type == AUserType::ADMIN)
            $route = 'usersPage';
        else
            $route = 'dashboard';

        return redirect()->route($route)->with('success', 'تم التحديث بنجاح.');
    }

    public function getDrinks()
    {
        if (auth()->user()->type != AUserType::ADMIN )
            return redirect()->route('dashboard')->with('error', 'ليس لديك تفويض لاتخاذ هذا الإجراء.');

        return view('drinks', ['drinks' => Drink::all()]);
    }


    public function addDrinkPage()
    {
        if (auth()->user()->type != AUserType::ADMIN )
            return redirect()->route('dashboard')->with('error', 'ليس لديك تفويض لاتخاذ هذا الإجراء.');

        return view('add-drink');
    }

    public function addDrink(AddDrinkRequest $request)
    {
        if (auth()->user()->type != AUserType::ADMIN )
            return redirect()->route('dashboard')->with('error', 'ليس لديك تفويض لاتخاذ هذا الإجراء.');

        $data = $request->validated();
        if (isset($data['image_url']))
        {
            $filename =$data['image_url']->store('public/drinks_images/'.uniqid());
            $imageUrl =trim($filename,'public');
            $data['image_url'] = $imageUrl;
        }
        Drink::query()->create($data);
        return redirect()->back()->with('success', 'تم اضافه المشروب بنجاح.');
    }

    public function deleteDrink($id)
    {
        if (auth()->user()->type != AUserType::ADMIN )
            return redirect()->route('dashboard')->with('error', 'ليس لديك تفويض لاتخاذ هذا الإجراء.');

        Drink::destroy([$id]);
        return back()->with('success', 'تم حذف المشروب بنجاح.');
    }

    public function orderDrink(OrderDrinkRequest $request)
    {
        $user = auth()->user();
        if ($user->number_of_drinks_ordered >= auth()->user()->number_of_drinks)
            return back()->with('error', 'لقد وصلت للحد الاقصي للمشاريب اليومي.');

        $data = $request->validated();
        EmployeeDrink::query()->create(['drink_id' => $data['drink_id'], 'hint' => $data['description'], 'user_id' => auth()->id(), 'drink_name' => Drink::query()->find($data['drink_id'])->name, 'floor_number' => $data['floor_number'], 'num_drinks' => $data['num_drinks'], 'sugar_num' => $data['sugar_num']]);
        $user->update(['number_of_drinks_ordered' => $user->number_of_drinks_ordered +1]);
        return redirect()->route('dashboard')->with('success', 'تم طلب المشروب بنجاح.');
    }

    public function drinkOrderedPageForOfficeBoy()
    {
        if (auth()->user()->type != AUserType::OFFICE_BOY)
            return back()->with('error', 'ليس لديك تفويض لاتخاذ هذا الإجراء.');

        $drinks = EmployeeDrink::query()->where('floor_number', auth()->user()->floor)->whereDate('created_at', Carbon::today())->get();
        return view('officeboy-drinks', ['drinks' => $drinks]);
    }

    public function completeOrder($id)
    {
        $order = EmployeeDrink::query()->findOrFail($id);
        if(auth()->user()->type == AUserType::OFFICE_BOY && auth()->user()->floor == $order->floor_number)
        {
            $order->update(['status' => DrinkStatus::COMPLETED, 'maker_id' => auth()->id()]);
            return back()->with('success', 'تم تحديد المشروب كا مكتمل بنجاح.');
        } else
            return back()->with('error', 'ليس لديك تفويض لاتخاذ هذا الإجراء.');
    }


    public function updateDrinkPage($id)
    {
        if (auth()->user()->type != AUserType::ADMIN )
            return redirect()->route('dashboard')->with('error', 'ليس لديك تفويض لاتخاذ هذا الإجراء.');
        return view('edit-drink', ['drink' => Drink::find($id)]);
    }

    public function orderDrinkPage()
    {
        if (auth()->user()->type == AUserType::ADMIN) {
            $drinks = Drink::query()->where('target', DrinkTarget::ADMIN)->orWhere('target', DrinkTarget::EMPLOYEE_AND_ADMIN)->orWhere('target', DrinkTarget::OFFICE_BOY_AND_ADMIN)->orWhere('target', DrinkTarget::OFFICE_BOY_AND_EMPLOYEE_AND_ADMIN)->get();
        } elseif (auth()->user()->type == AUserType::EMPLOYEE) {
            $drinks = Drink::query()->where('target', DrinkTarget::EMPLOYEE)->orWhere('target', DrinkTarget::EMPLOYEE_AND_ADMIN)->orWhere('target', DrinkTarget::OFFICE_BOY_AND_EMPLOYEE)->orWhere('target', DrinkTarget::OFFICE_BOY_AND_EMPLOYEE_AND_ADMIN)->get();
        } elseif(auth()->user()->type == AUserType::OFFICE_BOY) {
            $drinks = Drink::query()->where('target', DrinkTarget::OFFICE_BOY)->orWhere('target', DrinkTarget::OFFICE_BOY_AND_EMPLOYEE_AND_ADMIN)->orWhere('target', DrinkTarget::OFFICE_BOY_AND_EMPLOYEE)->orWhere('target', DrinkTarget::OFFICE_BOY_AND_ADMIN)->get();
        }

        return view('order-drink', ['drinks' => $drinks]);
    }

    public function updateDrink(UpdateDrinkRequest $request)
    {
        if (auth()->user()->type != AUserType::ADMIN )
            return redirect()->route('dashboard')->with('error', 'ليس لديك تفويض لاتخاذ هذا الإجراء.');

        $data = $request->validated();
        if (isset($data['image_url']))
        {
            $filename =$data['image_url']->store('public/drinks_images/'.uniqid());
            $imageUrl =trim($filename,'public');
            $data['image_url'] = $imageUrl;
        }
        Drink::query()->find($data['drink_id'])->update($data);
        return redirect()->route('drinksPage')->with('success', 'تم تعديل المشروب بنجاح.');
    }


    public function statistics()
    {
        if (auth()->user()->type != AUserType::ADMIN )
            return redirect()->route('dashboard')->with('error', 'ليس لديك تفويض لاتخاذ هذا الإجراء.');

        $users  =User::all();
        return view('statistics', [
            'numEmployee' => $this->convertNumbersToArabic($users->where('type', AUserType::EMPLOYEE)->count()),
            'numOfficeboy' => $this->convertNumbersToArabic($users->where('type', AUserType::OFFICE_BOY)->count()),
            'numAdmins' => $this->convertNumbersToArabic($users->where('type', AUserType::ADMIN)->count()),
            'numDrinks' => $this->convertNumbersToArabic(Drink::query()->count()),
            'numDrinksToday' => $this->convertNumbersToArabic(EmployeeDrink::query()->whereDate('created_at', Carbon::today())->count())
            ]);
    }

    public function checkAuthorize($user, $id = null)
    {
        return ($user->type != AUserType::ADMIN && $user->id != $id);
    }

    public function convertNumbersToArabic($number)
    {
        $westernArabic = array('0','1','2','3','4','5','6','7','8','9');
        $easternArabic = array('٠','١','٢','٣','٤','٥','٦','٧','٨','٩');
        return str_replace($westernArabic, $easternArabic, $number);

    }
}
