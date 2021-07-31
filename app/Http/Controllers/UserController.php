<?php

namespace App\Http\Controllers;

use App\Enums\AUserType;
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
        $drinksOrdered = EmployeeDrink::query()->where('user_id', auth()->id())->get();
        $drinks = Drink::all();
        return view('dashboard', ['drinks' => $drinks, 'drinksOrdered' => $drinksOrdered]);
    }
    public function usersPage()
    {
        $this->checkAuthorize(auth()->user());
        $users = User::query()->paginate(10);
        return view('users', ['users' => $users]);
    }

    public function addUser(AddUserRequest $request)
    {
//        $this->checkAuthorize(auth()->user());
        $data = $request->validated();
        $password = str_random(8);
        $data['password'] = $password;
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
        $this->checkAuthorize(auth()->user(), $data['id']);
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
        $data = $request->validated();
        EmployeeDrink::query()->create(['drink_id' => $data['drink_id'], 'hint' => $data['description'], 'user_id' => auth()->id(), 'drink_name' => Drink::query()->find($data['drink_id'])->name, 'floor_number' => $data['floor_number']]);
        return back()->with('success', 'تم طلب المشروب بنجاح.');
    }

    public function checkAuthorize($user, $id = null)
    {
        if ($user->type != AUserType::ADMIN && $user->id != $id)
            return back()->with('error', 'ليس لديك تفويض لاتخاذ هذا الإجراء.');
    }

}
