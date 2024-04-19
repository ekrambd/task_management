<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
    	try
    	{
    		$validator = Validator::make($request->all(), [
                'email' => 'required|email',
                'password' => 'required|min:6',
            ]);
       
            if($validator->fails()){
              return ['message'=>'The given data was invalid', 'data'=>$validator->errors()];  
            }

            if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){ 

                $user = Auth::user(); 
                $data['token'] =  $user->createToken('MyApp')->plainTextToken; 
                $data['id'] = $user->id;
                $data['name'] =  $user->name;
                $data['email'] = $user->email;

                return ['success'=>true, 'message'=>'User login successfully', 'data'=>$data];
            }

    	}catch(Exception $e){

            $code = $e->getCode();           
            return response()->json(['message'=>'Something went wrong', 'execption_code'=>$code]);
        }
    }

    public function logout(Request $request)
    {
    	auth()->user()->tokens()->delete();
    	return response()->json(['success'=>true, 'message'=>'Successfully Logged Out!']);
    }
}
