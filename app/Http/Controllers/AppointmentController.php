<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Http\Resources\AppointmentCollection;
use App\Http\Resources\AppointmentResource;
use App\Http\Resources\AppointmentDetailResource;
use App\Models\Prescription;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;


class AppointmentController extends Controller
{
    //
    public function getAppointments(){
        $appointment;
        $user=Auth::user();
        if($user->role==1){
            $appointment=Appointment::whereDate('created_at', Carbon::today())->paginate(5);
        } else {
            $appointment=Appointment::where('user_id',$user->id)->get();
        }
        return new AppointmentCollection($appointment);
    }

    public function addPrescription(Appointment $appointment){
        $prescriptionData = [
            'note' => 'take it in the morning and evening',
        ];    

        $prescription = $appointment
            ->prescription()
            ->create($prescriptionData);

        $numMedicines = (random_int(0, 1) === 0) ? 1 : 3;

        $medicinesData = [];
        for ($i = 1; $i <= $numMedicines; $i++) {
            $medicinesData[] = [
                'name' => 'Medicine ' . chr(65 + $i),
                'quantity' => random_int(1, 5),
                'price' => number_format(rand(100, 2000) / 100, 2),
                'prescription_id' => $prescription->id,
            ];
        }
        
        $prescription->medicines()->createMany($medicinesData);  
    }

    public function getSpecificAppointment($id){
        $appointment = Appointment::with(['prescription.medicines', 'order'])
                            ->find($id);
        if ($appointment != null) { 
            $appointment->doctor_name = $appointment->doctor->name;
            $appointment->user_name = $appointment->user->name;
            return $appointment;
        } else { 
            return response()->json('', 404);
        }

    }

    public function createAppointment(Request $request){
        $user=Auth::user();

        $input = $request->input();
        $date_string = $input['appointment_date'];

        $date = Carbon::createFromFormat('d-m-Y', $date_string)->format('Y-m-d');

        return Appointment::firstOrCreate([
            'doctor_id'=> $input['doctor_id'],
            'user_id'=> $input['user_id'],
            'payment_type_id'=>$input['payment_type_id'],
            'note' => isset($input['note']) ? $input['note'] : '',
            'status' => 0,
            'appointment_date' => $date
        ]);
    }

    public function test(Request $request) { 
        dd('hi there');
    }

    public function completeAppointment(Request $request) { 
        $user=Auth::user();
        if($user->role!=1) return response()->json([
            "message"=>"You don't have permission to "
        ],403);
        else {
            $input = $request->input();
            $appointment = Appointment::find($input['id']);

            if (!$appointment) {
                return response()->json(['message' => 'Appointment not found'], 404);
            }
    
            $appointment->status = 1; 
            $appointment->save();

            $generatePrescription = (bool) random_int(0, 1);

            if ($generatePrescription) { 
                $this->addPrescription($appointment);
            }

            $appointment = Appointment::with('prescription.medicines')->find($appointment->id);

            return $appointment;
        }
    }

    public function cancelAppointment(Request $request){
        $input = $request->input();
        
        $appointment = Appointment::find($input['id']);

        if (!$appointment) {
            return response()->json(['message' => 'Appointment not found'], 404);
        }

        $appointment->status = 2; // Set the status to 2 for cancelled
        $appointment->save();
    
        return response()->json(['message' => 'Appointment cancelled'], 200);
    }
}