<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Vet;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    public function index() {
        $vets = Vet::with('user')->inRandomOrder()->get();

        return view('petowner.appointment.index', compact('vets'));
    }

    public function makeAppointment(Vet $vet) {
        return view('petowner.appointment.make-appointment', compact('vet'));
    }

    public function store(Request $request, Vet $vet) {
        $request->validate([
            'pet_name' => 'required',
            'pet_type' => 'required',
            'date' => 'required',
            'time' => 'required',
        ]);

        Appointment::create([
            'pet_owner_id' => auth()->user()->petOwner->pet_owner_id,
            'vet_id' => $vet->vet_id,
            'pet_name' => $request->pet_name,
            'pet_type' => $request->pet_type,
            'date' => $request->date,
            'time' => $request->time,
            'status' => 'Upcoming'
        ]);

        return redirect('/vet/payment');
    }

    public function paymentAppointment() {
        $appointment = Appointment::where('pet_owner_id', auth()->user()->petOwner->pet_owner_id)->where('status', 'Upcoming')->first();

        return view('petowner.appointment.payment', compact('appointment'));
    }

    public function update(Request $request, Appointment $appointment) {
        $request->validate([
            'phone' => 'required|numeric',
            'payment' => 'required',
            'address' => 'required'
        ]);

        $appointment->update([
            'phone' => $request->phone,
            'payment' => $request->payment,
            'address' => $request->address
        ]);

        return redirect('/myappointment')->with('success', 'The appointment was made successfully');
    }

    public function myAppointment() {
        $appointment = Appointment::where('pet_owner_id', auth()->user()->petOwner->pet_owner_id)->where('status', 'Upcoming')->first();

        return view('petowner.appointment.myappointment', compact('appointment'));
    }
    
    public function updateAppointment(Appointment $appointment) {
        $appointment->update([
            'status' => 'Ended'
        ]);

        return redirect('/myappointment')->with('success', 'The appointment has ended');
    }
}