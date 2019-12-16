<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Domains;
use Validator;

class DomainsController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Domains::all();

        return $this->sendResponse($products->toArray(), 'Domainss retrieved successfully.');
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
            'domains' => 'required'
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }

        $product = Domains::create($input);

        return $this->sendResponse($product->toArray(), 'Domains created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Domains::find($id);

        if (is_null($product)) {
            return $this->sendError('Domains not found.');
        }

        return $this->sendResponse($product->toArray(), 'Domains retrieved successfully.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Domains $product)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'domains' => 'required' 
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }

        $product->domains = $input['domains']; 
        $product->save();

        return $this->sendResponse($product->toArray(), 'Domains updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Domains $product)
    {
        $product->delete();

        return $this->sendResponse($product->toArray(), 'Domains deleted successfully.');
    }
}
