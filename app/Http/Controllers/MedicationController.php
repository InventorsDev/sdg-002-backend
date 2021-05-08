<?php

namespace App\Http\Controllers;

use App\Contracts\MedicationRepository;
use App\Http\Resources\MedicationResource;
use App\Models\Medication;
use Illuminate\Http\Request;

class MedicationController extends Controller
{
    /**
     * @var object
     */
    protected $medicationRepository;

    public function __construct(MedicationRepository $medicationRepository)
    {
        $this->medicationRepository = $medicationRepository;
        $this->middleware(['auth:api']);
    }


    public function index()
    {
        $medications = auth()->user()->medications()->with('reminders')->latest()->get();
        return MedicationResource::collection($medications);
    }

    public function store(Request $request){
        $data = $request->validate([
            'drug_name' => 'required|string',
            'hours_per_dosage' => 'required|numeric',
            'no_of_days' => 'required|numeric',
            'dosage_started_at' => 'required|date',
            'dosage'    => 'required|string',
        ]);

        $medication = $this->medicationRepository->storeMedication($data);

        return ( ( new MedicationResource($medication) )->response()->setStatusCode(201));
    }

    public function show(Medication $medication)
    {
        $this->authorize('view', $medication);
        return ( ( new MedicationResource($medication) )->response()->setStatusCode(200));
    }

    public function reminders()
    {
        [
            'upcomingNotifications' => $upcoming, 
            'pastNotifications' => $past
        ] = $this->medicationRepository->getMedicationReminders();

        return response()->json(['data'=> compact('upcoming', 'past')]);
    }

    public function medicationReminders(Medication $medication)
    {
        [
            'upcomingNotifications' => $upcoming, 
            'pastNotifications' => $past
        ] = $this->medicationRepository->getMedicationReminders($medication->id);

        return response()->json(['data'=> compact('upcoming', 'past')]);
    }

    public function markAsRead($reminder)
    {
        $this->medicationRepository->markNotificationAsRead($reminder);
        return response()->json(null, 204);

    }

    public function markAsCompleted($reminder)
    {
        $this->medicationRepository->markNotificationAsCompleted($reminder);
        return response()->json(null, 204);
    }
}
