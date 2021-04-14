<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use App\Http\Requests\Auth\RegisterRequest;
use App\Repositories\UserRepository;

class RegisterController extends Controller
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;   
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \App\Http\Requests\RegisterRequest  $request
     * @return $token
     *
     */
    public function store(RegisterRequest $request)
    {
        
        $user = User::create([
            'name'      => $request->name,
            'email'      => $request->email,
            'phone_number' => $request->phone_number,
            'password'    => Hash::make($request->password)
        ]);

        event(new Registered($user));
        $this->saveGravatarAvatar($user);
        return $this->respondWithToken(Auth::login($user));
    }

    private function saveGravatarAvatar($user){
        $this->userRepository->saveGravatarAvatar($user);
    }
}
