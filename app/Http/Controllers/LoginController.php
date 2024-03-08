<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginUserRequest;
use App\Models\User;
use App\Repositories\UserRepositoryInterface;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function __construct(private UserRepositoryInterface $userRepository)
    {

    }

    public function create()
    {
        return view('login.create');
    }
    public function loginUser(LoginUserRequest $request): RedirectResponse
    {
        $result_user = $this->userRepository->findByUsername($request->username);
        if($result_user) {
            if(Hash::check($request->password,$result_user->password)) {
                Auth::login($result_user);
                return redirect('/home');
            }
            else {
                return redirect('/login')->with('error','Password is wrong.');
            }
        } else {
            return redirect('/login')->with('error','Username is wrong');
        }

    }

    public function logOutUser(): RedirectResponse
    {
        Auth::logout();
        return redirect('/');
    }

}
