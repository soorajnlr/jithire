<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Candidate_status;
use Validator;

class CandidatestatusController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Candidate_status::all();

        return $this->sendResponse($products->toArray(), 'Candidate_status retrieved successfully.');
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
            'Candidate_status' => 'required',
            'status_type' => 'required',
            'visible' => 'required'
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }

        $product = Candidate_status::create($input);

        return $this->sendResponse($product->toArray(), 'Candidate_status created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Candidate_status::find($id);

        if (is_null($product)) {
            return $this->sendError('Candidate_status not found.');
        }

        return $this->sendResponse($product->toArray(), 'Candidate_status retrieved successfully.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Candidate_status $product)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'candidate_status' => 'required',
            'status_type' => 'required',
            'visible' => 'required'
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }

        $product->candidate_status = $input['candidate_status'];
        $product->status_type = $input['status_type'];
        $product->visible = $input['visible'];
        $product->save();

        return $this->sendResponse($product->toArray(), 'Candidate_status updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Candidate_status $product)
    {
        $product->delete();

        return $this->sendResponse($product->toArray(), 'Candidate_status deleted successfully.');
    }
}
