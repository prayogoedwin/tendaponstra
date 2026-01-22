<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Device;
use Illuminate\Http\Request;

class DeviceController extends Controller
{
    public $title;
    public function __construct()
    {
        $this->title = 'Device';
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Device::get();
        $title = $this->title;
        return view('dashboard.device.index', compact('data', 'title'));
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
            'device_name' => 'required|string|min:3',
            'device_password' => 'required|string',
            'url_stream' => 'required|string|min:3',
            'device_id' => 'required|string|min:3',
            'username' => 'required|string|min:3',
            'password' => 'required|string|min:3',
            'port' => 'required|string|min:3',
            'websocket_port' => 'required|string|min:3',
            'tls_mqtt_url' => 'required|string|min:3',
            'tls_websocket_url' => 'required|string|min:3',
            'url_mqtt' => 'required|string|min:3',
            'prefix_topic' => 'required|string|min:3',
            'client_id' => 'required|string|min:3',
        ]);

        try {
            Device::create([
                'device_name' => $request->device_name,
                'device_password' => $request->device_password,
                'url_stream' => $request->url_stream,
                'device_id' => $request->device_id,
                'created_by' => auth()->user()->id,
                'port' => $request->port,
                'websocket_port' => $request->websocket_port,
                'tls_mqtt_url' => $request->tls_mqtt_url,
                'tls_websocket_url' => $request->tls_websocket_url,
                'username' => $request->username,
                'password' => $request->password,
                'url_mqtt' => $request->url_mqtt,
                'prefix_topic' => $request->prefix_topic,
                'client_id' => $request->client_id
            ]);
            return response()->json([
                'status' => true,
                'message' => 'Device berhasil ditambahkan'
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
    public function update(Request $request, Device $device)
    {
        $request->validate([
            'device_name' => 'required|string|min:3',
            'device_password' => 'required|string',
            'url_stream' => 'required|string|min:3',
            'device_id' => 'required|string|min:3',
            'username' => 'required|string|min:3',
            'password' => 'required|string|min:3',
            'port' => 'required|string|min:3',
            'websocket_port' => 'required|string|min:3',
            'tls_mqtt_url' => 'required|string|min:3',
            'tls_websocket_url' => 'required|string|min:3',
            'url_mqtt' => 'required|string|min:3',
            'prefix_topic' => 'required|string|min:3',
            'client_id' => 'required|string|min:3',
        ]);
        try {
            $device->update([
                'device_name' => $request->device_name,
                'device_password' => $request->device_password,
                'url_stream' => $request->url_stream,
                'device_id' => $request->device_id,
                'updated_by' => auth()->user()->id,
                'port' => $request->port,
                'websocket_port' => $request->websocket_port,
                'tls_mqtt_url' => $request->tls_mqtt_url,
                'tls_websocket_url' => $request->tls_websocket_url,
                'username' => $request->username,
                'password' => $request->password,
                'url_mqtt' => $request->url_mqtt,
                'prefix_topic' => $request->prefix_topic,
                'client_id' => $request->client_id
            ]);
            return response()->json([
                'status' => true,
                'message' => 'Device berhasil diupdate'
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
    public function destroy(Device $device)
    {
        try {
            $device->update([
                'deleted_by' => auth()->user()->id
            ]);
            $device->delete();
            return response()->json([
                'status' => true,
                'message' => 'Device berhasil dihapus'
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ]);
        }
    }
}
