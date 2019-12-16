<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Total_it_experience;
use Validator;

class TotalitexperienceController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $total_it_experience = Total_it_experience::all();

        return $this->sendResponse($total_it_experience->toArray(), 'Total_it_experiences retrieved successfully.');
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
            'total_it_experience' => 'required',
            'total_it_experience_cate' => 'required'
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }

        $total_it_experience = Total_it_experience::create($input);

        return $this->sendResponse($total_it_experience->toArray(), 'Total_it_experience created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $total_it_experience = Total_it_experience::find($id);

        if (is_null($total_it_experience)) {
            return $this->sendError('Total_it_experience not found.');
        }

        return $this->sendResponse($total_it_experience->toArray(), 'Total_it_experience retrieved successfully.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Total_it_experience $total_it_experience)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'total_it_experience' => 'required',
            'total_it_experience_cate' => 'required'
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }

        $total_it_experience->total_it_experience = $input['total_it_experience'];
        $total_it_experience->total_it_experience_cate = $input['total_it_experience_cate'];
        $total_it_experience->save();

        return $this->sendResponse($total_it_experience->toArray(), 'Total_it_experience updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Total_it_experience $total_it_experience)
    {
        $total_it_experience->delete();

        return $this->sendResponse($total_it_experience->toArray(), 'Total_it_experience deleted successfully.');
    }
}
