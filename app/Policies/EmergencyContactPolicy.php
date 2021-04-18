<?php

namespace App\Policies;

use App\Models\EmergencyContact;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class EmergencyContactPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\EmergencyContact  $emergencyContact
     * @return mixed
     */
    public function view(User $user, EmergencyContact $emergencyContact)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\EmergencyContact  $emergencyContact
     * @return mixed
     */
    public function update(User $user, EmergencyContact $emergencyContact)
    {
        return (int) $user->id === (int) $emergencyContact->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\EmergencyContact  $emergencyContact
     * @return mixed
     */
    public function delete(User $user, EmergencyContact $emergencyContact)
    {
        return (int) $user->id === (int) $emergencyContact->user_id;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\EmergencyContact  $emergencyContact
     * @return mixed
     */
    public function restore(User $user, EmergencyContact $emergencyContact)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\EmergencyContact  $emergencyContact
     * @return mixed
     */
    public function forceDelete(User $user, EmergencyContact $emergencyContact)
    {
        //
    }
}
