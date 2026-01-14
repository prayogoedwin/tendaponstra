<?php

namespace App\Services;

use App\Models\Sound;
use Illuminate\Support\Facades\File;

class SoundSyncService
{
    public static function syncToJson()
    {
        $sounds = Sound::select('id', 'name', 'path_file')->get();

        File::put(
            public_path('suara.json'),
            $sounds->toJson(JSON_PRETTY_PRINT)
        );
    }
}
