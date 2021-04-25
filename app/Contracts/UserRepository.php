<?php
namespace App\Contracts;

use App\Models\User;


interface UserRepository{

    /**
     *  Save avatar from gravatar
     */
    public function saveGravatarAvatar(User $user): void;
}