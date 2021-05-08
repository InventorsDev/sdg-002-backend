<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Medication extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'dosage_started_at' => 'datetime',
        'dosage_ended_at' => 'datetime'
    ];

    public function reminders(){
        return $this->hasMany(DatabaseNotification::class, 'data->medication_id');
    }
}
