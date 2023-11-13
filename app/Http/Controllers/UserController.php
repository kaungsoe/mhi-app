<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function login(Request $request){
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){ 
            $user = Auth::user(); 
            $success['token'] =  $user->createToken($user->name)->plainTextToken; 
            $success['name'] =  $user->name;
   
            return response()->json($success);
        } 
        else {
            return response()->json(["status"=>"Failed"], 401);
        }
        
    }
    
    public function register(Request $request){
        $input = $request->input();
        $input['role'] = 0;
        
        $validator = Validator::make($input, [
            'email' => 'required|email|unique:users,email',
        ]);
    
        if ($validator->fails()) {
            return response()->json(['error' => 'Email already exists'], 400);
        }    
        
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        $success['token'] =  $user->createToken($user->name)->plainTextToken;
        $success['name'] =  $user->name;
        $success['address']= $user->address;
        $success['email']= $user->email;
        $success['phone']=  $user->phone;
        $success['role'] = $user->role;
        return response()->json($success);    
    }
    
    public function updateUserInfo(Request $request){
        $user=Auth::user();
        $user->address=$request->address;
        if($request->address!=null) $user->address=$request->address;
        if($request->phone!=null) $user->phone= $request->phone;
        $user->save();
        return response()->json($user);
    }   

}
