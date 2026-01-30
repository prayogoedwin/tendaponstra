<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\Controller;
use App\Models\Device;
use App\Services\SoundSyncService;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    public function getDevice(Request $request)
    {
        try {
            $data = Device::where('device_password', $request->device_password)->first();
            if (!$data) {
                return $this->notFound('Device tidak ditemukan');
            }

            $response = [
                'id' => $data->id,
                'device_id' => $data->device_id,
                'device_name' => $data->device_name,
                'device_password' => $data->device_password,
                'url_stream' => $data->url_stream,
                'mqtt_config' => [
                    'url_mqtt' => $data->url_mqtt,
                    'client_id' => $data->client_id,
                    'prefix_topic' => $data->prefix_topic,
                    'username' => $data->username,
                    'password' => $data->password,
                    'port' => $data->port,
                    'websocket_port' => $data->websocket_port,
                    'tls_mqtt_url' => $data->tls_mqtt_url,
                    'tls_websocket_url' => $data->tls_websocket_url,
                ],
            ];

            return $this->ok($response);
        } catch (\Throwable $th) {
            return $this->error($th->getMessage());
        }
    }

    public function getSound()
    {
        try {
            $data = SoundSyncService::syncToJson();
            return $this->ok($data);
        } catch (\Throwable $th) {
            return $this->error($th->getMessage());
        }
    }
}
