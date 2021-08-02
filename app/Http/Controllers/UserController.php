<?php

namespace App\Http\Controllers;

use App\Enums\AUserType;
use App\Enums\DrinkStatus;
use App\Http\Requests\AddDrinkRequest;
use App\Http\Requests\AddUserRequest;
use App\Http\Requests\DeleteUserRequest;
use App\Http\Requests\OrderDrinkRequest;
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
        if (auth()->user()->type == AUserType::OFFICE_BOY)
            return redirect()->route('drinkOrderedPageForOfficeBoy');
        else{
            $drinksOrdered = EmployeeDrink::query()->where('user_id', auth()->id())->with('maker')->get();
            $drinks = Drink::all();
            return view('dashboard', ['drinks' => $drinks, 'drinksOrdered' => $drinksOrdered, 'number_of_drinks' => $this->convertNumbersToArabic(auth()->user()->number_of_drinks), 'number_of_drinks_ordered' => $this->convertNumbersToArabic(auth()->user()->number_of_drinks_ordered)]);
        }
    }
    public function usersPage()
    {
        $this->checkAuthorize(auth()->user());
        $users = User::query()->paginate(10);
        return view('users', ['users' => $users]);
    }

    public function addUser(AddUserRequest $request)
    {
        $this->checkAuthorize(auth()->user());
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
        $this->checkAuthorize(auth()->user());
        User::destroy([$id]);
        return back()->with('success', 'تم حذف المستخدم بنجاح.');
    }

    public function updateUserPage($id)
    {
        $this->checkAuthorize(auth()->user(), $id);

        return view('edit-user', ['user' => User::find($id)]);
    }

    public function updateUser(UpdateUserRequest $request)
    {
        $data = $request->validated();
        $this->checkAuthorize(auth()->user());
        if (isset($data['password']) && $data['password'])
            $data['password'] = Hash::make($data['password']);

        User::query()->find($data['id'])->update($data);
        if (auth()->user()->type == AUserType::ADMIN)
            $route = 'usersPage';
        else
            $route = 'dashboard';

        return redirect()->route($route)->with('success', 'تم التحديث بنجاح.');
    }

    public function getDrinks()
    {
        return view('drinks', ['drinks' => Drink::all()]);
    }


    public function addDrinkPage()
    {
        $this->checkAuthorize(auth()->user());
        return view('add-drink');
    }

    public function addDrink(AddDrinkRequest $request)
    {
        $this->checkAuthorize(auth()->user());
        Drink::query()->create($request->validated());
        return redirect()->back()->with('success', 'تم اضافه المشروب بنجاح.');
    }

    public function deleteDrink($id)
    {
        $this->checkAuthorize(auth()->user());
        Drink::destroy([$id]);
        return back()->with('success', 'تم حذف المشروب بنجاح.');
    }

    public function orderDrink(OrderDrinkRequest $request)
    {
        $user = auth()->user();
        if ($user->number_of_drinks_ordered >= auth()->user()->number_of_drinks)
            return back()->with('error', 'لقد وصلت للحد الاقصي للمشاريب اليومي.');

        $data = $request->validated();
        EmployeeDrink::query()->create(['drink_id' => $data['drink_id'], 'hint' => $data['description'], 'user_id' => auth()->id(), 'drink_name' => Drink::query()->find($data['drink_id'])->name, 'floor_number' => $data['floor_number']]);
        $user->update(['number_of_drinks_ordered' => $user->number_of_drinks_ordered +1]);
        return back()->with('success', 'تم طلب المشروب بنجاح.');
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

    public function checkAuthorize($user, $id = null)
    {
        if ($user->type != AUserType::ADMIN && $user->id != $id)
            return back()->with('error', 'ليس لديك تفويض لاتخاذ هذا الإجراء.');
    }

    public function convertNumbersToArabic($number)
    {
        $westernArabic = array('0','1','2','3','4','5','6','7','8','9');
        $easternArabic = array('٠','١','٢','٣','٤','٥','٦','٧','٨','٩');
        return str_replace($westernArabic, $easternArabic, $number);

    }


}
