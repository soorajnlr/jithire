<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\User;
use App\Company_details;

use Illuminate\Support\Facades\Auth;
use Validator;

class RegisterController extends BaseController
{
    /**
     * Register api
     *
     * @return \Illuminate\Http\Response
     */

    public $successStatus = 200;

    public function register(Request $request)
    {
        
       

         $validator = Validator::make($request->all(), [
                    'name' => 'required',
                    'email' => 'required|email',
                    'password' => 'required',
                    'confirmPassword' => 'required|same:password',
                    'terms' => 'required',
                ]);
      

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }

        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        $success['token'] =  $user->createToken('MyApp')->accessToken;
        $success['name'] =  $user->name;

        return $this->sendResponse($success, 'User register successfully.');
    }
    public function login(){ 
    if(Auth::attempt(['email' => request('email'), 'password' => request('password')])){ 
       $user = Auth::user(); 
       $success['token'] =  $user->createToken('AppName')-> accessToken; 
        return response()->json(['success' => $success], $this-> successStatus); 
      } else{ 
       return response()->json(['error'=>'Unauthorised'], 401); 
       } 
    }
  
    public function getUser() {
      //echo "test";exit;
     $user = Auth::user();
     return response()->json(['success' => $user], $this->successStatus); 
     }
} 