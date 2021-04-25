<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medication extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'dosage_started_at' => 'datetime',
        'dosage_ended_at' => 'datetime'
    ];
}
