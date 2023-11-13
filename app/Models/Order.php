<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'appointment_id',
        'prescription_id',
        'status',
        'payment_type_id',
    ];

    public function appointment(): BelongsTo
    {
        return $this->belongsTo(Appointment::class);
    }

    public function prescription(){
        return $this->hasOne(Prescription::class, 'id','prescription_id');
    }
}
