<?php

namespace App\Models;

use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Profile extends Model
{
    use HasFactory;

    protected $casts = [
        'date_of_birth' => 'datetime',
    ];

    protected $fillable = ['user_id', 'phone_number', 'address', 'gender', 'doctor', 'blood_group', 'next_of_kin', 'date_of_birth'];
}
