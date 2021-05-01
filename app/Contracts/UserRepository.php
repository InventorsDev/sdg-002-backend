<?php
namespace App\Contracts;

use App\Models\User;


interface UserRepository{

    /**
     *  Save avatar from gravatar
     *  @param User $user 
     */
    public function saveGravatarAvatar(User $user): void;

    /**
     *  Save user FCM token
     *  @param string $token
     */
    public function storeFCMToken(string $token): void;
}