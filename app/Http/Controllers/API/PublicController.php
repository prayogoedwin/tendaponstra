<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\Controller;
use App\Models\Device;
use App\Models\User;
use App\Notifications\SosNotification;
use App\Services\SoundSyncService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use NotificationChannels\Fcm\FcmChannel;

class PublicController extends Controller
{
    public function getDevice(Request $request)
    {
        try {
            $data = Device::where('device_password', $request->device_password)->first();
            if (!$data) {
                return $this->notFound('Device tidak ditemukan');
            }

            $data->update([
                'user_id' => $request->user_id
            ]);

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

    // public function handle(Request $request)
    // {
    //     try {
    //         Log::info('Antares Webhook Received', $request->all());

    //         $cin = $request->input('m2m:sgn.nev.rep.m2m:cin');

    //         if (!$cin) {
    //             return response()->json(['message' => 'Invalid payload'], 400);
    //         }

    //         // data mentah dari device
    //         $content = $cin['con'];

    //         // biasanya string JSON
    //         $data = json_decode($content, true);

    //         // contoh simpan ke DB
    //         // SensorData::create($data);

    //         Log::info('Parsed Data', $data);

    //         return response()->json(['status' => 'ok'], 200);
    //     } catch (\Throwable $th) {
    //         Log::error('Error Antares', $th->getMessage());
    //     }
    // }

    public function handle(Request $request)
    {
        try {
            // Log::info('Antares Webhook Received', $request->all());

            // ambil CIN
            $cin = data_get(
                $request->all(),
                'm2m:sgn.m2m:nev.m2m:rep.m2m:cin'
            );

            if (!$cin || !isset($cin['con'])) {
                throw new \Exception('CIN tidak ditemukan');
            }

            // decode con (STRING → ARRAY)
            $payload = json_decode($cin['con'], true);

            if (json_last_error() !== JSON_ERROR_NONE) {
                return response()->json(['success' => false, 'message' => 'Invalid payload con'], 400);
            }

            $devEui = data_get($payload, 'devEui');
            $lat = data_get($payload, 'data.lat');
            $lng = data_get($payload, 'data.lng');

            // Log::info('ID dari Antares', ['devEui' => $devEui, 'lat' => $lat, 'lng' => $lng]);

            // $device = Device::where('device_id', $devEui)->first();
            $user = User::where('email', 'atasnama740@gmail.com')->first();
            $user->notify(new SosNotification(FcmChannel::class, 'SOS Tolong Bossssss', [
                'lat' => $lat,
                'lng' => $lng
            ]));


            return response()->json([
                'success' => true
            ], 200);
        } catch (\Throwable $th) {
            return response()->json(['success' => false, 'message' => $th->getMessage()]);
        }
    }
}
