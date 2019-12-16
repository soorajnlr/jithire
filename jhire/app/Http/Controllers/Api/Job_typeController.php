<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Job_type;
use Validator;

class Job_typeController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $job_type = Job_type::all();

        return $this->sendResponse($job_type->toArray(), 'Job_type retrieved successfully.');
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
            'job_type' => 'required' 
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }

        $job_type = Job_type::create($input);

        return $this->sendResponse($job_type->toArray(), 'Job_type created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $job_type = Job_type::find($id);

        if (is_null($job_type)) {
            return $this->sendError('Job_type not found.');
        }

        return $this->sendResponse($job_type->toArray(), 'Job_type retrieved successfully.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Job_type $job_type)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'job_type' => 'required' 
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }

        $job_type->job_type = $input['job_type']; 
        $job_type->save();

        return $this->sendResponse($job_type->toArray(), 'Job_type updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Job_type $job_type)
    {
        $job_type->delete();

        return $this->sendResponse($job_type->toArray(), 'Job_type deleted successfully.');
    }
}
