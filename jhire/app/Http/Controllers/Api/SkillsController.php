<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Skills;
use Validator;

class SkillsController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $skills = Skills::all();

        return $this->sendResponse($skills->toArray(), 'Skillss retrieved successfully.');
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
            'skills' => 'required',
            'skills_cate' => 'required'
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }

        $skills = Skills::create($input);

        return $this->sendResponse($skills->toArray(), 'Skills created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $skills = Skills::find($id);

        if (is_null($skills)) {
            return $this->sendError('Skills not found.');
        }

        return $this->sendResponse($skills->toArray(), 'Skills retrieved successfully.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Skills $skills)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'skills' => 'required',
            'skills_cate' => 'required'
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }

        $skills->skills = $input['skills'];
        $skills->skills_cate = $input['skills_cate'];
        $skills->save();

        return $this->sendResponse($skills->toArray(), 'Skills updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Skills $skills)
    {
        $skills->delete();

        return $this->sendResponse($skills->toArray(), 'Skills deleted successfully.');
    }
}
