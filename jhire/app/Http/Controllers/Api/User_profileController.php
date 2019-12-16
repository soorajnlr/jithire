<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\User_profile;
use Validator;

class User_profileController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_profile = User_profile::all();

        return $this->sendResponse($user_profile->toArray(), 'User profiles retrieved successfully.');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'user_profile' => 'required',
            'user_profile_cate' => 'required'
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }

        $user_profile = User_profile::create($input);

        return $this->sendResponse($user_profile->toArray(), 'User_profile created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user_profile = User_profile::find($id);

        if (is_null($user_profile)) {
            return $this->sendError('User_profile not found.');
        }

        return $this->sendResponse($user_profile->toArray(), 'User_profile retrieved successfully.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User_profile $user_profile)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'user_profile' => 'required',
            'user_profile_cate' => 'required'
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }

        $user_profile->user_profile = $input['user_profile'];
        $user_profile->user_profile_cate = $input['user_profile_cate'];
        $user_profile->save();

        return $this->sendResponse($user_profile->toArray(), 'User_profile updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User_profile $user_profile)
    {
        $user_profile->delete();

        return $this->sendResponse($user_profile->toArray(), 'User_profile deleted successfully.');
    }
}
