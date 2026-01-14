<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Device;
use App\Models\TrackingDevice;
use Illuminate\Http\Request;

class TrackingDeviceController extends Controller
{
    public $title;
    public function __construct()
    {
        $this->title = 'Tracking Device';
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = TrackingDevice::with('device')->get();
        $title = $this->title;
        $devices = Device::select('id', 'device_name')->get();
        return view('dashboard.tracking.index', compact('data', 'title', 'devices'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'device_id' => 'required',
            'lat' => 'required',
            'lng' => 'required',
            'batt' => 'required',
            'obj_dist' => 'required'
        ]);
        try {
            TrackingDevice::create($request->all());
            return response()->json([
                'status' => true,
                'message' => 'Tracking Device berhasil ditambahkan'
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TrackingDevice $tracking)
    {
        $request->validate([
            'device_id' => 'required',
            'lat' => 'required',
            'lng' => 'required',
            'batt' => 'required',
            'obj_dist' => 'required'
        ]);
        try {
            $tracking->update($request->all());
            return response()->json([
                'status' => true,
                'message' => 'Tracking Device berhasil diupdate'
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TrackingDevice $tracking)
    {
        try {
            $tracking->delete();
            return response()->json([
                'status' => true,
                'message' => 'Tracking Device berhasil dihapus'
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ]);
        }
    }
}
