<?php

namespace App\Http\Controllers;

use App\Pc;
use Illuminate\Http\Request;
use Validator;
use App\Http\Resources\Pc as PcResource;
use App\Http\Resources\Component as ComponentResource;

class PcController extends BaseController
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		$pcs = Pc::all();
	
		return $this->sendResponse(PcResource::collection($pcs), 'PCs retrieved successfully.');
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		$input = $request->all();
   
		$validator = Validator::make($input, [
			'nombre' => 'required',
			'descripcion' => 'required',   
			'costo' => 'required'
		]);
   
		if($validator->fails()){
			return $this->sendError('Validation Error.', $validator->errors());       
		}
   
		$pc = Pc::create($input);
   
		return $this->sendResponse(new PcResource($pc), 'PC created successfully.');
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
			'nombre' => 'required',
			'descripcion' => 'required',   
			'costo' => 'required'
		]);
   
		if($validator->fails()){
			return $this->sendError('Validation Error.', $validator->errors());       
		}
   
		$pc = Pc::create($input);
   
		return $this->sendResponse(new PcResource($pc), 'PC created successfully.');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\Pc  $pc
	 * @return \Illuminate\Http\Response
	 */
	public function show($id)
	{          
		$pc = Pc::find($id);
		if (is_null($pc)) {
			return $this->sendError('PC not found.');
		}
   
		return $this->sendResponse(new PcResource($pc), 'PC retrieved successfully.');
	}

	public function components($id)
	{          
		$pc = Pc::find($id);
		if (is_null($pc)) {
			return $this->sendError('PC not found.');
		}
   
		return $this->sendResponse(new ComponentResource($pc->components), 'PC updated successfully.');
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\Pc  $pc
	 * @return \Illuminate\Http\Response
	 */
	public function edit(Pc $pc)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \App\Pc  $pc
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, Pc $pc)
	{      

		$input = $request->all();
   
		$validator = Validator::make($input, [
			'nombre' => 'required',
			'descripcion' => 'required',
			'costo' => 'required'
		]);
   
		if($validator->fails()){
			return $this->sendError('Validation Error.', $validator->errors());       
		}
   
		$pc->nombre = $input['nombre'];
		$pc->descripcion = $input['descripcion'];
		$pc->costo = $input['costo'];
		$pc->save();
   
		return $this->sendResponse(new PcResource($pc), 'PC updated successfully.');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Pc  $pc
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{
		$pc = Pc::find($id);
		if (is_null($pc)) {
			return $this->sendError('PC not found.');
		}
		$pc->delete();
   
		return $this->sendResponse([], 'PC deleted successfully.');
	}
}
