<?php

namespace App\Http\Controllers;

use App\Contracts\UserRepository;
use App\Enums\Status;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->middleware(['auth:api']);
        $this->userRepository = $userRepository;
    }

    public function fcmToken(Request $request)
    {
        $request->validate([
            'token' => 'required'
        ]);

        $this->userRepository->storeFCMToken($request->token);

        return response()->json(['status' => Status::SUCCESS, 'message' => 'token saved'], 200);
    }
}
