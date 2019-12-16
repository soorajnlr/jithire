<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\User;
use DB;
use App\Company_details;

use Illuminate\Support\Facades\Auth;
use Validator;

class EmployerController extends BaseController
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
                    'companyName' => 'required',
                    'email' => 'required|email|unique:users',
                    'url' => 'required|unique:Company_details',
                    'tan' => 'required',
                    'pocName' => 'required',
                    'phoneNo' => 'required',                    
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
        
        if($user){

            $input['user_id']=$user->id;
            $input['company_name']=$input['companyName'];
            $input['url']=$input['url'];
            $input['city']='Test';//.$input['city'];
            $input['state']='test';//.$input['state'];

            $input['country']='India';
            $input['role']='company';//$input['state'];
            $input['status']='active';
            $input['email']=$input['email'];
            $input['password']=bcrypt($input['password']);
            
            $input['TAN']=$input['tan'];
            $input['poc_name']=$input['pocName'];
            $input['phone_no']=$input['phoneNo']; 

            $details =Company_details::create($input);
        }
         
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
       
     $user = Auth::user();
     return response()->json(['success' => $user], $this->successStatus); 
     }

    public function logout(){

        if (Auth::check()) {
            Auth::user()->token()->revoke();
            return response()->json(['success' =>'logout_success'],200); 
        }else{
            return response()->json(['error' =>'api.something_went_wrong'], 500);
        }
    }
} 