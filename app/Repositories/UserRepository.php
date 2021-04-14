<?php
namespace App\Repositories;

use App\Models\User;
use App\Repositories\BaseRepository;
use Gravatar;
use Log;
use Str;

class UserRepository extends BaseRepository
{


    public function saveGravatarAvatar(User $user){
        if(Gravatar::exists($user->email)){
            $avatar = $user->addMediaFromUrl( Gravatar::get($user->email) )
                ->usingFileName(Str::slug(explode(' ', $user->name)[0]).'.jpg')
                ->toMediaCollection('avatar');
            Log::info($avatar);   
        }
    }
}