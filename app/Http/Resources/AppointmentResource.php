<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AppointmentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'doctor'=>$this->doctor->name,
            'user'=> $this->user->name,
            'payment'=>$this->paymentType->name,
            'note' => $this->note,
            'status' => $this->status,
            'appointment_date' => $this->appointment_date
        ];
    }
}
