<?php

namespace App\Http\Controllers;

use App\Enums\Status;
use Illuminate\Http\Request;
use App\Events\AlertEmergency;
use Illuminate\Validation\Rule;
use App\Contracts\UserRepository;

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

    public function profileUpdate(Request $request)
    {
        $data = $request->validate([
            'phone_number' => 'nullable',
            'address' => 'nullable',
            'gender' => Rule::in(['male', 'female']),
            'doctor' => 'nullable',
            'blood_group' => 'nullable',
            'next_of_kin' => 'nullable',
            'date_of_birth' => 'nullable|date',
        ]);

        $profile = $this->userRepository->updateProfile($data);

        return response()->json(['data' => $profile], 200);
    }

    public function alertContacts()
    {
        event( new AlertEmergency(auth()->user()));
    }
}
