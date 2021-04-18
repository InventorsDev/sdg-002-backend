<?php
namespace App\Repositories;

use App\Contracts\EmergencyContactRepository as EmergencyContactRepositoryContract;
use App\Models\User;
use App\Models\EmergencyContact;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;

class EmergencyContactRepository extends BaseRepository implements EmergencyContactRepositoryContract
{

    public function __construct()
    {
        
    }

    /**
    * @return Collection
    */
    public function userContacts() :Collection{
        return auth()->user()->contacts;
    }

    /**
    * @param array $attributes
    * @return Model
    */
    public function storeContact($data) :Model{
        $data = (object) $data;
        $user = auth()->user();
        $contact = $user->contacts()->create([
            "name" => $data->name,
            "email" => $data->email,
            "phone_number" => $data->phone_number,
            "relationship" => $data->relationship
        ]);
        return  $contact;
    }

    /**
    * @param EmergencyContact $contact
    * @return Model
    */
    public function updateContact($contact, array $data) :Model{
        $contact->update($data);
        
        return $contact;
    }

    /**
    * @param int $id
    * @return void
    */
    public function deleteContact($id): void{
        $contact = EmergencyContact::findOrFail($id);
        $contact->delete();
    }

}