<?php

namespace App\Http\Controllers;

use App\Models\AssetTransfer;
use App\Models\Assets;
use App\Models\User;
use App\Models\Branch;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

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
        $validated = $request->validate([
            'asset_id' => 'required|exists:assets,id',

            'from_user_id' => 'required|exists:users,id',
            'to_user_id' => 'required|exists:users,id',

            'from_branch_id' => 'required|exists:branches,id',
            'to_branch_id' => 'required|exists:branches,id',

            'from_department_id' => 'required|exists:departments,id',
            'to_department_id' => 'required|exists:departments,id',

            'transfer_date' => 'required|date',
            'reason' => 'nullable|string'
        ]);

        DB::beginTransaction();

        try {
            // Simpan transfer
            $transfer = AssetTransfer::create($validated);

            // Update asset agar pindah user/cabang/departemen
            Assets::where('id', $validated['asset_id'])->update([
                'user_id' => $validated['to_user_id'],
                'branch' => $validated['to_branch_id'],          // sesuai tabel assets
                'department' => $validated['to_department_id'],  // sesuai tabel assets
            ]);

            DB::commit();

            return redirect()->route('asset_transfers.index')
                ->with('success', 'Transfer aset berhasil disimpan!');

        } catch (\Throwable $e) {

            DB::rollBack();
            Log::error("AssetTransfer store error: " . $e->getMessage());

            return back()->withErrors('Gagal menyimpan transfer aset.');
        }
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
            'asset_id' => 'required|exists:assets,id',
            'to_user_id' => 'required|exists:users,id',
            'to_branch_id' => 'required|exists:branches,id',
            'to_department_id' => 'required|exists:departments,id',
            'transfer_date' => 'required|date',
            'reason' => 'nullable|string',
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

        // UPDATE asset saat edit
        Assets::where('id', $request->asset_id)->update([
            'user_id' => $request->to_user_id,
            'branch' => $request->to_branch_id,
            'department' => $request->to_department_id,
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
