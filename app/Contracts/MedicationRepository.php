<?php
namespace App\Contracts;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

interface MedicationRepository{

    /**
     *  Store medication and create reminder notifications
     *  @param array $data
     *  @return Model
     */
    public function storeMedication($data) :Model;

     /**
     *  Store medication and create reminder notifications
     *  @param int $data
     *  @return Model
     */
    public function getMedicationById($id) :Model;

    /**
     *  Get user medication reminder notifications
     * 
     *  @return array
     */
    public function getMedicationReminders() : array;

     /**
     *  Get user medication reminder notifications
     *  @param $id
     *  @return void
     */
    public function markNotificationAsRead($notificationId) : void;

     /**
     *  Get user medication reminder notifications
     *  @param $id
     *  @return void
     */
    public function markNotificationAsCompleted($notificationId) : void;
}