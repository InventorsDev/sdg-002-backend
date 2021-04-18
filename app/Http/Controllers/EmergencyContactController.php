<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\EmergencyContact;
use App\Contracts\EmergencyContactRepository;
use App\Http\Resources\Contact\EmergencyContactResource;

class EmergencyContactController extends Controller
{
    private $emergencyContactRepository;

    public function __construct(EmergencyContactRepository $emergencyContactRepository)
    {
        $this->middleware(['auth:api']);
        $this->emergencyContactRepository = $emergencyContactRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contacts = $this->emergencyContactRepository->userContacts();
        return ( EmergencyContactResource::collection($contacts) )->response()->setStatusCode(200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            "name" => "required|string|max:225",
            "email" => [
                'required',  
                Rule::unique(EmergencyContact::class)->where('user_id', $request->user()->id)
            ],
            "phone_number" => [
                'required',  
                Rule::unique(EmergencyContact::class)->where('user_id', $request->user()->id)
            ],
            "relationship" => "nullable|string"
        ]);

        $contact = $this->emergencyContactRepository->storeContact($data);

        return ( ( new EmergencyContactResource($contact) )->response()->setStatusCode(201));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\EmergencyContact  $emergencyContact
     * @return \Illuminate\Http\Response
     */
    public function show(EmergencyContact $emergencyContact)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\EmergencyContact  $emergencyContact
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EmergencyContact $emergencyContact)
    {
        $this->authorize('update', $emergencyContact);

        $request->validate([
            "name" => "required|string|max:225",
            "email" => [
                'required',  
                Rule::unique(EmergencyContact::class)
                ->where('user_id', $request->user()->id)
                ->ignore($emergencyContact)
            ],
            "phone_number" => [
                'required',  
                Rule::unique(EmergencyContact::class)
                ->where('user_id', $request->user()->id)
                ->ignore($emergencyContact)
            ],
            "relationship" => "nullable|string"
        ]);

        $data = $request->only(['name', 'email', 'phone_number', 'relationship']);

        $contact = $this->emergencyContactRepository->updateContact($emergencyContact, $data);

        return ( ( new EmergencyContactResource($contact) )->response()->setStatusCode(200));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\EmergencyContact  $emergencyContact
     * @return \Illuminate\Http\Response
     */
    public function destroy(EmergencyContact $emergencyContact)
    {
        $this->authorize('delete', $emergencyContact);

        $this->emergencyContactRepository->deleteContact($emergencyContact->id);
        return response()->json(null, 204);
    }
}
