<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Gender;
use Validator;

class GenderController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Gender::all();

        return $this->sendResponse($products->toArray(), 'Gender retrieved successfully.');
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
            'gender' => 'required'
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }

        $product = Gender::create($input);

        return $this->sendResponse($product->toArray(), 'Gender created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Gender::find($id);

        if (is_null($product)) {
            return $this->sendError('Gender not found.');
        }

        return $this->sendResponse($product->toArray(), 'Gender retrieved successfully.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Gender $product)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'gender' => 'required' 
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }

        $product->gender = $input['gender']; 
        $product->save();

        return $this->sendResponse($product->toArray(), 'Gender updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Gender $product)
    {
        $product->delete();

        return $this->sendResponse($product->toArray(), 'Gender deleted successfully.');
    }
}
