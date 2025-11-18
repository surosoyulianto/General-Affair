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
        $assets = Assets::all();
        $users = User::all();
        $branches = Branch::all();
        $departments = Department::all();

        return view('asset_transfers.create', compact(
            'assets', 'users', 'branches', 'departments'
        ));
    }

    /**
     * Simpan transfer asset baru.
     */
    public function store(Request $request)
    {
        $request->validate([
            'asset_id'      => 'required',
            'to_user_id'    => 'required',
            'transfer_date' => 'required|date',
        ]);

        // Ambil data aset sekarang
        $asset = Assets::findOrFail($request->asset_id);

        // Simpan log transfer
        $transfer = AssetTransfer::create([
            'asset_id'           => $request->asset_id,

            'from_user_id'       => $asset->user_id ?? null,
            'to_user_id'         => $request->to_user_id,

            'from_branch_id'     => $asset->branch ?? null,
            'to_branch_id'       => $request->to_branch_id ?? $asset->branch,

            'from_department_id' => $asset->department ?? null,
            'to_department_id'   => $request->to_department_id ?? $asset->department,

            'transfer_date'      => $request->transfer_date,
            'reason'             => $request->reason,
        ]);

        // Update aset: owner baru & lokasi baru
        $asset->update([
            'user_id'    => $request->to_user_id,
            'branch'     => $request->to_branch_id ?? $asset->branch,
            'department' => $request->to_department_id ?? $asset->department,
        ]);

        return redirect()->route('asset_transfers.index')
            ->with('success', 'Asset transfer berhasil disimpan.');
    }

    /**
     * Detail transfer asset.
     */
    public function show($id)
    {
        $transfer = AssetTransfer::with([
            'asset', 'fromUser', 'toUser',
            'fromBranch', 'toBranch',
            'fromDepartment', 'toDepartment'
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
            'transfer', 'assets', 'users', 'branches', 'departments'
        ));
    }

    /**
     * Update transfer asset.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'asset_id'      => 'required',
            'to_user_id'    => 'required',
            'transfer_date' => 'required|date',
        ]);

        $transfer = AssetTransfer::findOrFail($id);

        $transfer->update([
            'asset_id'           => $request->asset_id,
            'from_user_id'       => $transfer->from_user_id,
            'to_user_id'         => $request->to_user_id,

            'from_branch_id'     => $transfer->from_branch_id,
            'to_branch_id'       => $request->to_branch_id,

            'from_department_id' => $transfer->from_department_id,
            'to_department_id'   => $request->to_department_id,

            'transfer_date'      => $request->transfer_date,
            'reason'             => $request->reason,
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
