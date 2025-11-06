<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use App\Models\User;
use App\Models\Department;
use App\Models\Branch;
use Illuminate\Http\Request;

class AssetController extends Controller
{
    /**
     * Tampilkan daftar semua asset.
     */
    public function index()
    {
        $assets = Asset::with(['user', 'departmentRelation', 'branchRelation'])->paginate(10);
        return view('assets.index', compact('assets'));
    }

    /**
     * Tampilkan form untuk membuat asset baru.
     */
    public function create()
    {
        $users = User::all();
        $departments = Department::all();
        $branches = Branch::all();

        return view('assets.create', compact('users', 'departments', 'branches'));
    }

    /**
     * Simpan asset baru ke database.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'asset_number' => 'required|unique:assets_it,asset_number',
            'name' => 'required|string|max:255',
            'branch' => 'nullable|string',
            'department' => 'nullable|string',
            'specification' => 'nullable|string',
            'serial_number' => 'nullable|string',
            'ram_capacity' => 'nullable|string',
            'type_asset' => 'nullable|string',
            'storage_type' => 'nullable|string',
            'storage_volume' => 'nullable|string',
            'os_edition' => 'nullable|string',
            'os_installed' => 'nullable|date',
            'brand' => 'nullable|string',
            'model' => 'nullable|string',
            'purchase_date' => 'nullable|date',
            'purchase_value' => 'nullable|string',
            'location' => 'nullable|string',
            'status' => 'nullable|string',
            'description' => 'nullable|string',
            'assigned_to' => 'nullable|exists:users,id',
        ]);

        Asset::create($validated);

        return redirect()->route('assets.index')->with('success', 'Asset created successfully.');
    }

    /**
     * Tampilkan detail asset tertentu.
     */
    public function show($id)
    {
        $asset = Asset::with(['user', 'departmentRelation', 'branchRelation'])->findOrFail($id);
        return view('assets.show', compact('asset'));
    }

    /**
     * Tampilkan form edit asset.
     */
    public function edit($id)
    {
        $asset = Asset::findOrFail($id);
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
        $asset = Asset::findOrFail($id);

        $validated = $request->validate([
            'asset_number' => 'required|unique:assets_it,asset_number,' . $id,
            'name' => 'required|string|max:255',
            'branch' => 'nullable|string',
            'department' => 'nullable|string',
            'specification' => 'nullable|string',
            'serial_number' => 'nullable|string',
            'ram_capacity' => 'nullable|string',
            'type_asset' => 'nullable|string',
            'storage_type' => 'nullable|string',
            'storage_volume' => 'nullable|string',
            'os_edition' => 'nullable|string',
            'os_installed' => 'nullable|date',
            'brand' => 'nullable|string',
            'model' => 'nullable|string',
            'purchase_date' => 'nullable|date',
            'purchase_value' => 'nullable|string',
            'location' => 'nullable|string',
            'status' => 'nullable|string',
            'description' => 'nullable|string',
            'assigned_to' => 'nullable|exists:users,id',
        ]);

        $asset->update($validated);

        return redirect()->route('assets.index')->with('success', 'Asset updated successfully.');
    }

    /**
     * Hapus asset.
     */
    public function destroy($id)
    {
        $asset = Asset::findOrFail($id);
        $asset->delete();

        return redirect()->route('assets.index')->with('success', 'Asset deleted successfully.');
    }
}
