<?php

namespace App\Http\Controllers;

use App\Models\AssetTransfer;
use App\Models\Assets;
use App\Models\User;
use App\Models\Branch;
use App\Models\Department;
use Illuminate\Http\Request;

class AssetTransferController extends Controller
{
    /**
     * Tampilkan semua data transfer asset.
     */
    public function index()
    {
        $transfers = AssetTransfer::with(['asset', 'fromUser', 'toUser'])
            ->latest()
            ->paginate(10);

        return view('asset_transfers.index', compact('transfers'));
    }

    /**
     * Form create transfer baru.
     */
    public function create()
    {
        $assets = Assets::with(['user'])->get();
        $users = User::all();
        $branches = Branch::all();
        $departments = Department::all();

        return view('asset_transfers.create', compact('assets', 'users', 'branches', 'departments'));
    }

    /**
     * Simpan transfer asset baru.
     */
    public function store(Request $request)
    {
        // Validasi input dari Blade
        $request->validate([
            'asset_id' => 'required',
            'owner_from' => 'required',
            'owner_to' => 'required',
            'branch_from' => 'required',
            'branch_to' => 'required',
            'department_from' => 'required',
            'department_to' => 'required',
            'transfer_date' => 'required|date',
        ]);

        // Ambil data asset
        $asset = Assets::findOrFail($request->asset_id);

        // Simpan ke tabel asset_transfers
        $transfer = AssetTransfer::create([
            'asset_id' => $request->asset_id,

            'from_user_id' => $request->owner_from,
            'to_user_id' => $request->owner_to,

            'from_branch_id' => $request->branch_from,
            'to_branch_id' => $request->branch_to,

            'from_department_id' => $request->department_from,
            'to_department_id' => $request->department_to,

            'transfer_date' => $request->transfer_date,
            'reason' => $request->notes,
        ]);

        // Update data asset sesuai perubahan terakhir
        $asset->update([
            'user_id' => $request->user_id,
            'branch' => $request->branch,
            'department' => $request->department,
        ]);

        return redirect()->route('asset_transfers.index')
            ->with('success', 'Transfer aset berhasil disimpan.');
    }

    /**
     * Detail transfer asset.
     */
    public function show($id)
    {
        $transfer = AssetTransfer::with([
            'asset',
            'fromUser',
            'toUser',
            'fromBranch',
            'toBranch',
            'fromDepartment',
            'toDepartment'
        ])->findOrFail($id);

        return view('asset_transfers.show', compact('transfer'));
    }

    /**
     * Form edit transfer.
     */
    public function edit($id)
    {
        $transfer = AssetTransfer::findOrFail($id);

        $assets = Assets::all();
        $users = User::all();
        $branches = Branch::all();
        $departments = Department::all();

        return view('asset_transfers.edit', compact(
            'transfer',
            'assets',
            'users',
            'branches',
            'departments'
        ));
    }

    /**
     * Update transfer asset.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'asset_id' => 'required',
            'to_user_id' => 'required',
            'transfer_date' => 'required|date',
        ]);

        $transfer = AssetTransfer::findOrFail($id);

        $transfer->update([
            'asset_id' => $request->asset_id,
            'from_user_id' => $transfer->from_user_id,
            'to_user_id' => $request->to_user_id,

            'from_branch_id' => $transfer->from_branch_id,
            'to_branch_id' => $request->to_branch_id,

            'from_department_id' => $transfer->from_department_id,
            'to_department_id' => $request->to_department_id,

            'transfer_date' => $request->transfer_date,
            'reason' => $request->reason,
        ]);

        return redirect()->route('asset_transfers.index')
            ->with('success', 'Asset transfer berhasil diupdate.');
    }

    /**
     * Hapus data transfer.
     */
    public function destroy($id)
    {
        AssetTransfer::findOrFail($id)->delete();

        return redirect()->route('asset_transfers.index')
            ->with('success', 'Asset transfer berhasil dihapus.');
    }
}
