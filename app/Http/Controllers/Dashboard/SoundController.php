<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Sound;
use App\Services\SoundSyncService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class SoundController extends Controller
{
    public $title;
    public function __construct()
    {
        $this->title = 'Sound';
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Sound::get();
        $title = $this->title;
        $sounds = Sound::select('id', 'name', 'path_file')->get();

        // auto-sync ke suara.json setiap request
        SoundSyncService::syncToJson();
        return view('dashboard.sound.index', compact('data', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = $this->title;
        return view('dashboard.sound.create', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'  => 'required|string|min:3',
            'sound' => 'required|file|mimetypes:audio/mpeg,audio/mp3|max:5120',
        ]);
        try {
            $file = $request->file('sound');

            $filename = Str::slug($request->name) . '.mp3';

            $path = $file->move(public_path('sound'), $filename);

            $sound = Sound::create([
                'name' => $request->name,
                'path_file' => 'sound/' . $filename,
            ]);
            return redirect()->route('sound.index')->with('success', 'Sound berhasil ditambahkan');
        } catch (\Throwable $th) {
            return redirect()->route('sound.index')->with('error', 'Sound gagal ditambahkan');
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
    public function edit(Sound $sound)
    {
        $title = $this->title;
        return view('dashboard.sound.edit', compact('sound', 'title'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Sound $sound)
    {
        $request->validate([
            'name'  => 'required|string|min:3',
            'sound' => 'nullable|file|mimetypes:audio/mpeg,audio/mp3|max:5120',
        ]);

        try {
            // === JIKA UPLOAD FILE BARU ===
            if ($request->hasFile('sound')) {
                if ($sound->path_file && File::exists(public_path($sound->path_file))) {
                    File::delete(public_path($sound->path_file));
                }
                $file = $request->file('sound');
                $filename = Str::slug($request->name) . '.mp3';
                $file->move(public_path('sound'), $filename);

                $sound->path_file = 'sound/' . $filename;
            }
            $sound->name = $request->name;
            $sound->save();

            return redirect()
                ->route('sound.index')
                ->with('success', 'Sound berhasil diupdate');
        } catch (\Throwable $th) {
            return redirect()
                ->route('sound.index')
                ->with('error', 'Sound gagal diupdate');
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sound $sound)
    {
        try {
            if ($sound->path_file && File::exists(public_path($sound->path_file))) {
                File::delete(public_path($sound->path_file));
            }
            $sound->delete();
            return redirect()->route('sound.index')->with('success', 'Sound berhasil dihapus');
        } catch (\Throwable $th) {
            return redirect()->route('sound.index')->with('error', 'Sound gagal dihapus');
        }
    }
}
