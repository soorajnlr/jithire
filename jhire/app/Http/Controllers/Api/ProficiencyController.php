<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Proficiency;
use Validator;

class ProficiencyController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $proficiencys = Proficiency::all();

        return $this->sendResponse($proficiencys->toArray(), 'Proficiencys retrieved successfully.');
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
            'proficiency' => 'required' 
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }

        $proficiency = Proficiency::create($input);

        return $this->sendResponse($proficiency->toArray(), 'Proficiency created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $proficiency = Proficiency::find($id);

        if (is_null($proficiency)) {
            return $this->sendError('Proficiency not found.');
        }

        return $this->sendResponse($proficiency->toArray(), 'Proficiency retrieved successfully.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Proficiency $proficiency)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'proficiency' => 'required'
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }

        $proficiency->proficiency = $input['proficiency']; 
        $proficiency->save();

        return $this->sendResponse($proficiency->toArray(), 'Proficiency updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Proficiency $proficiency)
    {
        $proficiency->delete();

        return $this->sendResponse($proficiency->toArray(), 'Proficiency deleted successfully.');
    }
}
