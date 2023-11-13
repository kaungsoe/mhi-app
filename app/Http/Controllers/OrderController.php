<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Models\Order;

class OrderController extends Controller
{
    //
    public function order(Request $request){
        $input = $request->input();
        $app_id = $input['appointment_id'];
        $appointment = Appointment::with('prescription.medicines')
                            ->find($app_id);

        $orderData = [
            'appointment_id'=> $app_id,
            'prescription_id'=> $input['prescription_id'],
            'status' => 0,
            'payment_type_id' => $input['payment_type'],
        ];    

        $prescription = $appointment
            ->order()
            ->create($orderData);

        return response()->json(['message' => 'Order Submitted'], 200);
    }

    public function completeOrder(Request $request){
        $input = $request->input();
        $order = Order::find($input['order_id']);

        if (!$order) {
            return response()->json(['message' => 'Order not found'], 404);
        }

        $order->status = 1; // completed 
        $order->save();
    
        return response()->json(['message' => 'Order completed'], 200);
    }
}
