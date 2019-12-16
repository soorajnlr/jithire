<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Cities;
use Validator;

class CitiesController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Cities::all();

        return $this->sendResponse($products->toArray(), 'Citiess retrieved successfully.');
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
            'city_name' => 'required',
            'city_state' => 'required'
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }

        $product = Cities::create($input);

        return $this->sendResponse($product->toArray(), 'Cities created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Cities::find($id);

        if (is_null($product)) {
            return $this->sendError('Cities not found.');
        }

        return $this->sendResponse($product->toArray(), 'Cities retrieved successfully.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cities $product)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'city_name' => 'required',
            'city_state' => 'required'
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }

        $product->city_name = $input['city_name'];
        $product->city_state = $input['city_state'];
        $product->save();

        return $this->sendResponse($product->toArray(), 'Cities updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cities $product)
    {
        $product->delete();

        return $this->sendResponse($product->toArray(), 'Cities deleted successfully.');
    }
}
