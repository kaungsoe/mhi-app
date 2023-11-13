<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    use HasFactory;

    protected $table = 'feedbacks';
    protected $fillable = ['user_id', 'feedback_type_id', 'feedback'];

    public function feedbackType()
    {
        return $this->belongsTo(FeedbackType::class);
    }
}