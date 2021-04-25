<?php
namespace App\Repositories;

use App\Models\User;
use App\Repositories\BaseRepository;
use Gravatar;
use App\Repositories\UserRepository as UserRepositoryContract;
use Str;

class UserRepository extends BaseRepository implements UserRepositoryContract
{


    public function saveGravatarAvatar(User $user){
        if(Gravatar::exists($user->email)){
            $avatar = $user->addMediaFromUrl( Gravatar::get($user->email) )
                ->usingFileName(Str::slug(explode(' ', $user->name)[0]).'.jpg')
                ->toMediaCollection('avatar');
        }
    }
}