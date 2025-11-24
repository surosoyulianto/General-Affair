<?php

namespace App\Http\Controllers;

use App\Models\Assets;
use App\Models\User;
use App\Models\Department;
use App\Models\Branch;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AssetController extends Controller
{
    /**
     * Tampilkan daftar semua asset.
     */
    public function index()
    {
        // Ambil assets beserta relasi user
        $assets = Assets::with('user')->paginate(10);

        // Ambil daftar user untuk dropdown
        $users = User::select('id', 'name')->orderBy('name')->get();

        return view('assets.index', compact('assets', 'users'));
    }

    /**
     * Tampilkan form untuk membuat asset baru.
     */
    public function create()
    {
        $assets = Assets::all();
        $users = User::all();
        $branches = Branch::all();
        $departments = Department::all();

        return view('assets.create', compact('assets', 'users', 'branches', 'departments'));
    }

    /**
     * Simpan asset baru ke database.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'asset_number' => 'required|unique:assets,asset_number',
            'asset_name' => 'required|string|max:255',
            'branch' => 'nullable|string',
            'department' => 'nullable|string',
            'type_asset' => 'nullable|string',
            'brand' => 'nullable|string',
            'model' => 'nullable|string',
            'specification' => 'nullable|string',
            'serial_number' => 'nullable|string',
            'ram_capacity' => 'nullable|string',
            'storage_type' => 'nullable|string',
            'storage_volume' => 'nullable|string',
            'os_edition' => 'nullable|string',
            'os_installed' => 'nullable|date',
            'purchase_date' => 'nullable|date',
            'purchase_value' => 'nullable|string',
            'location' => 'nullable|string',
            'status' => 'nullable|string',
            'description' => 'nullable|string',
            'user_id' => 'nullable|exists:users,id',
        ]);

        Assets::create($validated);

        return redirect()->route('assets.index')->with('success', 'Asset created successfully.');
    }

    /**
     * Tampilkan detail asset tertentu.
     */
    public function show($id)
    {
        $asset = Assets::with('user')->findOrFail($id);
        return view('assets.show', compact('asset'));
    }

    /**
     * Tampilkan form edit asset.
     */
    public function edit($id)
    {
        $asset = assets::findOrFail($id);
        $users = User::all();
        $departments = Department::all();
        $branches = Branch::all();

        return view('assets.edit', compact('asset', 'users', 'departments', 'branches'));
    }

    /**
     * Update data asset.
     */
    public function update(Request $request, $id)
    {
        $asset = Assets::findOrFail($id);

        $validated = $request->validate([
            'asset_number' => 'required|unique:assets,asset_number,' . $asset->id,
            'asset_name' => 'required|string|max:255',
            'branch' => 'nullable|string',
            'department' => 'nullable|string',
            'type_asset' => 'nullable|string',
            'brand' => 'nullable|string',
            'model' => 'nullable|string',
            'specification' => 'nullable|string',
            'serial_number' => 'nullable|string',
            'ram_capacity' => 'nullable|string',
            'storage_type' => 'nullable|string',
            'storage_volume' => 'nullable|string',
            'os_edition' => 'nullable|string',
            'os_installed' => 'nullable|date',
            'purchase_date' => 'nullable|date',
            'purchase_value' => 'nullable|string',
            'location' => 'nullable|string',
            'status' => 'nullable|string',
            'description' => 'nullable|string',
            'assigned_to' => 'nullable|exists:users,id',
        ]);

        // optional: update user_id who last updated asset
        $validated['user_id'] = Auth::id();

        $asset->update($validated);

        return redirect()->route('assets.index')->with('success', 'Asset updated successfully.');
    }

    /**
     * Hapus asset.
     */
    public function destroy($id)
    {
        $asset = Assets::findOrFail($id);
        $asset->delete();

        return redirect()->route('assets.index')->with('success', 'Asset deleted successfully.');
    }
    public function getAssetDetail($id)
    {
        $asset = Assets::with(['user', 'departmentRelation', 'branchRelation'])->find($id);

        return response()->json($asset);
    }
    public function detailByNumber($asset_number)
    {
        dd($asset_number);
        $asset = Assets::where('asset_number', $asset_number)
            ->with(['user', 'branch_relation', 'department_relation'])
            ->first();

        return response()->json($asset);
    }

}
