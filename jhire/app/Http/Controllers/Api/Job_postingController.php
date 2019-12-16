<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Job_posting;
use Validator;

class Job_postingController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $job_posting = Job_posting::all();

        return $this->sendResponse($job_posting->toArray(), 'Job_postings retrieved successfully.');
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
            'job_posting' => 'required',
            'job_posting_cate' => 'required'
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }

        $job_posting = Job_posting::create($input);

        return $this->sendResponse($job_posting->toArray(), 'Job_posting created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $job_posting = Job_posting::find($id);

        if (is_null($job_posting)) {
            return $this->sendError('Job_posting not found.');
        }

        return $this->sendResponse($job_posting->toArray(), 'Job_posting retrieved successfully.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Job_posting $job_posting)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'job_posting' => 'required',
            'job_posting_cate' => 'required'
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }

        $job_posting->job_posting = $input['job_posting'];
        $job_posting->job_posting_cate = $input['job_posting_cate'];
        $job_posting->save();

        return $this->sendResponse($job_posting->toArray(), 'Job_posting updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Job_posting $job_posting)
    {
        $job_posting->delete();

        return $this->sendResponse($job_posting->toArray(), 'Job_posting deleted successfully.');
    }
}
