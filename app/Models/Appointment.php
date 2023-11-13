<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'doctor_id',
        'user_id',
        'payment_type_id',
        'note',
        'status',
        "appointment_date"
    ];


    public function doctor()
    {
        return $this->hasOne(Doctor::class,'id','doctor_id');
    }

    public function user()
    {
        return $this->hasOne(User::class,'id','user_id');
    }
    public function paymentType()
    {
        return $this->hasOne(PaymentType::class,'id','payment_type_id');
    }

    public function prescription()
    {
        return $this->hasOne(Prescription::class);//->withDefault();
    }

    public function order()
    {
        return $this->hasOne(Order::class);//->withDefault();
    }
}
