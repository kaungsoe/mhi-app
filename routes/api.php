<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\MedicineControllers;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\OrderController;

// User
Route::post('v1/login',[UserController::class,'login']);
Route::post('v1/register',[UserController::class,'register']);

Route::group([
	'middleware' => 'auth:sanctum'
], function() {
    Route::put('v1/user',[UserController::class,'updateUserInfo']);
    
    // Appointment
    Route::get('v1/appointments',[AppointmentController::class, 'getAppointments']); // if role is admin, return all today appointments otherwise return user appointment
    Route::get('v1/appointments/{id}',[AppointmentController::class, 'getSpecificAppointment']);
    Route::post('v1/appointment',[AppointmentController::class,'createAppointment']);
    Route::post('v1/appointment/cancel',[AppointmentController::class,'cancelAppointment']);
    Route::post('v1/appointment/complete',[AppointmentController::class,'completeAppointment']);
    Route::post('v1/addPrescription',[AppointmentController::class,'addPrescription']);

    // manage doctor 
    Route::delete('v1/doctors/{id}',[DoctorController::class,'destroy']);
    Route::post('v1/doctor/',[DoctorController::class,'store']);
    Route::put('v1/doctor/',[DoctorController::class,'update']);

    // Prescription 
    Route::post('v1/order/',[OrderController::class,'order']); 
    Route::post('v1/order/complete',[OrderController::class,'completeOrder']);

    // Feedback
    Route::get('v1/getFeedbackTypes', [FeedbackController::class, 'getFeedbackTypes']);
    Route::post('v1/submitFeedback', [FeedbackController::class, 'submitFeedback']);
    Route::get('v1/feedbacks', [FeedbackController::class, 'getFeedbacks']);

})->middleware('api');

// Doctor
Route::get('v1/doctors',[DoctorController::class, 'index']);
Route::get('v1/doctors/{id}',[DoctorController::class,'show']);

Route::get('v1/test',[AppointmentController::class, 'test']);

// Medicine 
Route::get('v1/medicines',[MedicineController::class,'index']);

// Payment
Route::get('v1/payments',[PaymentController::class, 'getPaymentList']);

// Others
Route::get('v1/contacts',[ContactController::class, 'getContacts']);