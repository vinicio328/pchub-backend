<?php

namespace App\Http\Controllers;

use App\ComponentPc;
use App\Pc;
use Illuminate\Http\Request;
use Validator;
use App\Http\Resources\Component as ComponentResource;

class ComponentPCController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Pc $pc)
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Pc $pc, Request $request)
    {      
        $pc->components()->attach($request->get('components'));
        return $this->sendResponse(new ComponentResource($pc->components), 'PC updated successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ComponentPc  $componentPc
     * @return \Illuminate\Http\Response
     */
    public function show(ComponentPc $componentPc)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ComponentPc  $componentPc
     * @return \Illuminate\Http\Response
     */
    public function edit(ComponentPc $componentPc)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ComponentPc  $componentPc
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ComponentPc $componentPc)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ComponentPc  $componentPc
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pc $pc, $id)
    {
        $pc->components()->detach($id);
        return $this->sendResponse(new ComponentResource($pc->components), 'PC updated successfully.');
    }
}
