<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public $title;

    public function __construct()
    {
        $this->title = 'Role';
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Role::all();
        $title = $this->title;
        return view('dashboard.role.index', compact('data', 'title'));
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
            'name' => 'required|string|min:3|unique:roles,name',
        ]);
        try {
            // ubah menjadi huruh kecil semua, dan gunakan '_' jika ada spasi
            Role::create([
                'name' => strtolower(str_replace(' ', '_', $request->name))
            ]);

            return response()->json([
                'status' => true,
                'message' => 'Role berhasil ditambahkan'
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
    public function update(Request $request, Role $role)
    {
        $request->validate([
            'name' => 'required|string|min:3|unique:roles,name,' . $role->id
        ]);
        try {
            $role->update([
                'name' => strtolower(str_replace(' ', '_', $request->name))
            ]);
            return response()->json([
                'status' => true,
                'message' => 'Role berhasil diubah'
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
    public function destroy(Role $role)
    {
        try {
            $role->delete();
            return response()->json([
                'status' => true,
                'message' => 'Role berhasil dihapus'
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ]);
        }
    }
}
