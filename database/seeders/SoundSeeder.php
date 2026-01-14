<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SoundSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = ['awas', 'belok kanan', 'belok kiri', 'kanan', 'ke kanan', 'ke kiri', 'kiri', 'maju ke depan', 'maju', 'mundur ke belakang', 'mundur', 'stop'];

        foreach ($data as $key => $value) {
            \App\Models\Sound::create([
                'name' => $value,
                'path_file' => 'sound/' . $value . '.mp3',
            ]);
        }
    }
}
