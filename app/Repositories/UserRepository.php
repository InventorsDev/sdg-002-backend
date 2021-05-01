<?php
namespace App\Repositories;

use Str;
use Gravatar;
use App\Models\User;
use App\Contracts\UserRepository as UserRepositoryContract;
use App\Models\Profile;
use App\Repositories\BaseRepository;

class UserRepository extends BaseRepository implements UserRepositoryContract
{


    public function saveGravatarAvatar(User $user) :void{
        if(Gravatar::exists($user->email)){
            $avatar = $user->addMediaFromUrl( Gravatar::get($user->email) )
                ->usingFileName(Str::slug(explode(' ', $user->name)[0]).'.jpg')
                ->toMediaCollection('avatar');
        }
    }

    public function storeFCMToken(string $token): void 
    {
        $user = User::find(auth()->user()->id);
        $user->update(['fcm_token' => $token]);
    }

    public function updateProfile(array $data) : Profile
    {
        $profile = auth()->user()->profile;
        $profile->update($data);
        return $profile;
    }
}