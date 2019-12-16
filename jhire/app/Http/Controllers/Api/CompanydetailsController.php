<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Company_details;
use Validator;

class CompanydetailsController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //echo "dtes";exit;
        $companydetails = Company_details::all();

        return $this->sendResponse($companydetails->toArray(), 'Companydetails retrieved successfully.');
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
            'companydetails' => 'required',
            'companydetails_cate' => 'required'
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }

        $companydetails = Company_details::create($input);

        return $this->sendResponse($companydetails->toArray(), 'Companydetails created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $companydetails = Company_details::find($id);

        if (is_null($companydetails)) {
            return $this->sendError('Companydetails not found.');
        }

        return $this->sendResponse($companydetails->toArray(), 'Companydetails retrieved successfully.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Companydetails $companydetails)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'companydetails' => 'required',
            'companydetails_cate' => 'required'
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }

        $companydetails->companydetails = $input['companydetails'];
        $companydetails->companydetails_cate = $input['companydetails_cate'];
        $companydetails->save();

        return $this->sendResponse($companydetails->toArray(), 'Companydetails updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Companydetails $companydetails)
    {
        $companydetails->delete();

        return $this->sendResponse($companydetails->toArray(), 'Companydetails deleted successfully.');
    }
}
