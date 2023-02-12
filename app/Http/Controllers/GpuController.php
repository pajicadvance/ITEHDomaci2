<?php

namespace App\Http\Controllers;

use App\Models\Gpu;
use Illuminate\Http\Request;

class GpuController extends Controller
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

        $Gpu = Gpu::create([
            'name' => $request->name,
            'manufacturer_id' => $manufacturer->id,
            'user_id' => Auth::user()->id,
            'clock' => $request->clock,
            'vram' => $request->vram,
        ]);

        return response()->json([
            'message' => 'Gpu has been created successfully',
            'gpu' => new GpuResource($Gpu),
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
     * @param  \App\Models\Gpu  $Gpu
     * @return \Illuminate\Http\Response
     */
    public function show($Gpu_id)
    {
        return new GpuResource(Gpu::find($Gpu_id));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Gpu  $Gpu
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $Gpu_id)
    {
        $manufacturerNames = array_values((array) Manufacturer::pluck('name'))[0];
        $GpuIds = array_values((array) Gpu::pluck('id'))[0];

        if(!in_array($Gpu_id, $GpuIds)){
            return response()->json([
                'message' => 'Gpu ID does not exist',
            ]);
        }
        if(!in_array($request->manufacturer, $manufacturerNames)){
            return response()->json([
                'message' => 'Manufacturer name does not exist',
            ]);
        }

        $manufacturer = Manufacturer::where('name', $request->manufacturer)->get()->first();

        $Gpu = Gpu::find($Gpu_id);
        $Gpu->manufacturer_id = $manufacturer->id;
        $Gpu->user_id = Auth::user()->id;
        $Gpu->name = $request->name;
        $Gpu->clock = $request->clock;
        $Gpu->vram = $request->vram;

        $Gpu->save();

        return response()->json([
            'message' => 'Gpu updated successfully',
            'gpu' => new GpuResource($Gpu),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Gpu  $Gpu
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Gpu $Gpu)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Gpu  $Gpu
     * @return \Illuminate\Http\Response
     */
    public function destroy($Gpu_id)
    {
        $GpuIds = array_values((array) Gpu::pluck('id'))[0];

        if(!in_array($Gpu_id, $GpuIds)){
            return response()->json([
                'message' => 'Gpu ID does not exist',
            ]);
        }

        $Gpu = Gpu::find($Gpu_id); 

        if (!$Gpu->delete()) {
            return response()->json([
                'error' => 'Unable to delete the Gpu'
            ]);
        }

        return response()->json([
            'message' => 'Gpu deleted successfully',
            'gpu' => new GpuResource($Gpu),
        ]);
    }
}
