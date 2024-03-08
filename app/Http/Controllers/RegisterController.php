<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Repositories\UserRepositoryInterface;
use Illuminate\Http\RedirectResponse;

class RegisterController extends Controller
{
    public function __construct(private UserRepositoryInterface $userRepository)
    {

    }
    public function create()
    {
        return view('register.create');
    }

    public function store(StoreUserRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['password'] = bcrypt($data['password']);

        $this->userRepository->insertUser($data);


        return redirect('/register')->with('success','You are now a registered user!');

    }


}
