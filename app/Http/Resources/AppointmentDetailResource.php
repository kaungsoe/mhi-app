<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AppointmentDetailResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [    
            'id' => $this->id,
            'doctor_name' => $this->doctor->name,
            'patient_name' => $this->user->name,
            'payment_type_id' => $this->payment_type_id,
            'note' => $this->note,
            'status' => $this->status,
            'appointment_date' => $this->appointment_date,
            'prescription' => new PrescriptionResource($this->whenLoaded('prescription')),
        ];
    }
}
