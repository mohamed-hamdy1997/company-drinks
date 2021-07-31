<?php

namespace App\Http\Controllers;

use App\Enums\AUserType;
use App\Http\Requests\AddUserRequest;
use App\Http\Requests\DeleteUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Mail\SendAccountDataForNewUsers;
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

    public function login(Request $request)
    {

    }

    public function usersPage()
    {
        $users = User::query()->paginate(10);
        return view('users', ['users' => $users]);
    }
    public function addUser(AddUserRequest $request)
    {
//        dd($request->validated());
//        checkType(auth()->user(), AUserType::ADMIN);
        $data = $request->validated();
        $password = str_random(8);
        $data['password'] = $password;
        $user = User::query()->create($data);
        try {
            Mail::to($user)->send(new SendAccountDataForNewUsers($user, $password));
        } catch (\Exception $e) {
            User::destroy([$user->id]);
            return back()->with('error','Email not sent to user');
        }
        return back()->with('success','User added successfully');
    }

    public function deleteUser(DeleteUserRequest $request)
    {
        checkType(auth()->user(), AUserType::ADMIN);
        User::query()->delete($request->validated()['user_id']);
        return back()->with('success','User deleted successfully');
    }

    public function updateUserPage($id)
    {
        return view('edit-user', ['user' => User::find($id)]);
    }
    public function updateUser(UpdateUserRequest $request)
    {
        $request->validated();
        User::query()->update($request->validated());
        if (auth()->user()->type == AUserType::ADMIN)
            $route = 'usersPage';
        else
            $route = 'dashboard';

        return redirect()->route($route)->with('success','Updated successfully');
       }
}
