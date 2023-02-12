<?php

namespace App\Http\Controllers;

use App\Models\GPU;
use Illuminate\Http\Request;

class GPUController extends Controller
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
    public function create()
    {
        $manufacturerNames = array_values((array) Manufacturer::pluck('name'))[0];
        if(!in_array($request->manufacturer, $manufacturerNames)){
            return response()->json([
                'message' => 'Manufacturer name does not exist',
            ]);
        }
        $manufacturer = Manufacturer::where('name', $request->manufacturer)->get()->first();

        $gpu = GPU::create([
            'name' => $request->name,
            'manufacturer_id' => $manufacturer->id,
            'user_id' => Auth::user()->id,
            'clock' => $request->clock,
            'vram' => $request->vram,
        ]);

        return response()->json([
            'message' => 'GPU has been created successfully',
            'gpu' => new GPUResource($gpu),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\GPU  $gPU
     * @return \Illuminate\Http\Response
     */
    public function show($gpu_id)
    {
        return new GPUResource(GPU::find($gpu_id));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\GPU  $gPU
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $gpu_id)
    {
        $manufacturerNames = array_values((array) Manufacturer::pluck('name'))[0];
        $gpuIds = array_values((array) GPU::pluck('id'))[0];

        if(!in_array($gpu_id, $gpuIds)){
            return response()->json([
                'message' => 'GPU ID does not exist',
            ]);
        }
        if(!in_array($request->manufacturer, $manufacturerNames)){
            return response()->json([
                'message' => 'Manufacturer name does not exist',
            ]);
        }

        $manufacturer = Manufacturer::where('name', $request->manufacturer)->get()->first();

        $gpu = GPU::find($gpu_id);
        $gpu->manufacturer_id = $manufacturer->id;
        $gpu->user_id = Auth::user()->id;
        $gpu->name = $request->name;
        $gpu->clock = $request->clock;
        $gpu->vram = $request->vram;

        $gpu->save();

        return response()->json([
            'message' => 'GPU updated successfully',
            'gpu' => new GPUResource($gpu),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\GPU  $gPU
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, GPU $gPU)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\GPU  $gPU
     * @return \Illuminate\Http\Response
     */
    public function destroy($gpu_id)
    {
        $gpuIds = array_values((array) GPU::pluck('id'))[0];

        if(!in_array($gpu_id, $gpuIds)){
            return response()->json([
                'message' => 'GPU ID does not exist',
            ]);
        }

        $gpu = GPU::find($gpu_id); 

        if (!$gpu->delete()) {
            return response()->json([
                'error' => 'Unable to delete the GPU'
            ]);
        }

        return response()->json([
            'message' => 'GPU deleted successfully',
            'gpu' => new GPUResource($gpu),
        ]);
    }
}
