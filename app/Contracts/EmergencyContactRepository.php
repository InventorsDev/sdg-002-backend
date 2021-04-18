<?php
namespace App\Contracts;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface EmergencyContactRepository{

    /**
    * @return Collection
    */
    public function userContacts() :Collection;
      
    /**
    * @param array $attributes
    * @return Model
    */
    public function storeContact(array $attributes) :Model;

    /**
    * @param EmergencyContact $contact
    * @return Model
    */
    public function updateContact($contact, array $data) :Model;

     
    /**
    * @param int $id
    * @return void
    */
    public function deleteContact($id): void;
}