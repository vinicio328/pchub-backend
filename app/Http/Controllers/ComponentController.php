<?php

namespace App\Http\Controllers;

use App\Component;
use Illuminate\Http\Request;
use Validator;
use App\Http\Resources\Component as ComponentResource;

class ComponentController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $components = Component::all();
    
        return $this->sendResponse(ComponentResource::collection($components), 'Components retrieved successfully.');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
   
        $component = Component::create($input);
   
        return $this->sendResponse(new ComponentResource($component), 'Component created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Component  $component
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $component = Component::find($id);
        if (is_null($component)) {
            return $this->sendError('Component not found.');
        }
   
        return $this->sendResponse(new ComponentResource($component), 'Component retrieved successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Component  $component
     * @return \Illuminate\Http\Response
     */
    public function edit(Component $component)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Component  $component
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Component $component)
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
   
        $component->nombre = $input['nombre'];
        $component->descripcion = $input['descripcion'];
        $component->costo = $input['costo'];
        $component->save();
   
        return $this->sendResponse(new ComponentResource($component), 'Component updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Component  $component
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $component = Component::find($id);
        if (is_null($component)) {
            return $this->sendError('Component not found.');
        }
        $component->delete();
   
        return $this->sendResponse([], 'Component deleted successfully.');
    }
}
