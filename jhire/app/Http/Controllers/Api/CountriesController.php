<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Countries;
use Validator;

class CountriesController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Countries::all();

        return $this->sendResponse($products->toArray(), 'Countriess retrieved successfully.');
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
            'country_code' => 'required',
            'country_name' => 'required'
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }

        $product = Countries::create($input);

        return $this->sendResponse($product->toArray(), 'Countries created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Countries::find($id);

        if (is_null($product)) {
            return $this->sendError('Countries not found.');
        }

        return $this->sendResponse($product->toArray(), 'Countries retrieved successfully.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Countries $product)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'country_code' => 'required',
            'country_name' => 'required'
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }

        $product->country_code = $input['country_code'];
        $product->country_name = $input['country_name'];
        $product->save();

        return $this->sendResponse($product->toArray(), 'Countries updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Countries $product)
    {
        $product->delete();

        return $this->sendResponse($product->toArray(), 'Countries deleted successfully.');
    }
}
