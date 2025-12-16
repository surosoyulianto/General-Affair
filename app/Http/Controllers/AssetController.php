<?php

namespace App\Http\Controllers;

use App\Models\Assets;
use App\Models\User;
use App\Models\AssetUpload;
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
        $assets = Assets::with(['user'])->paginate(10);

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

        return view('assets.create', compact('assets', 'users'));
    }

    /**
     * Simpan asset baru ke database.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'asset_no' => 'nullable|string',
            'description' => 'nullable|string',
            'dept' => 'nullable|string',
            'acquisition_date' => 'nullable|date',
            'end_date' => 'nullable|date',
            'voucher_aqc' => 'nullable|string',
            'base_price' => 'nullable|numeric',
            'accumulation_last_year' => 'nullable|numeric',
            'ending_book_value_last_year' => 'nullable|numeric',
            'dep_rate' => 'nullable|numeric',
            'depreciation_yearly' => 'nullable|numeric',
            'book_value_last_month' => 'nullable|numeric',
            'depreciation_accum_depr' => 'nullable|numeric',
            'depreciation_book_value' => 'nullable|numeric',
            'user_id' => 'nullable|exists:users,id',
        ]);

        // Set user_id ke user yang sedang login
        $validated['user_id'] = Auth::id();

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
        $asset = Assets::findOrFail($id);
        $users = User::all();

        return view('assets.edit', compact('asset', 'users'));
    }

    /**
     * Update data asset.
     */
    public function update(Request $request, $id)
    {
        $asset = Assets::findOrFail($id);

        $validated = $request->validate([
            'asset_no' => 'nullable|string',
            'description' => 'nullable|string',
            'dept' => 'nullable|string',
            'acquisition_date' => 'nullable|date',
            'end_date' => 'nullable|date',
            'voucher_aqc' => 'nullable|string',
            'base_price' => 'nullable|numeric',
            'accumulation_last_year' => 'nullable|numeric',
            'ending_book_value_last_year' => 'nullable|numeric',
            'dep_rate' => 'nullable|numeric',
            'depreciation_yearly' => 'nullable|numeric',
            'book_value_last_month' => 'nullable|numeric',
            'depreciation_accum_depr' => 'nullable|numeric',
            'depreciation_book_value' => 'nullable|numeric',
            'user_id' => 'nullable|exists:users,id',
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

    /**
     * Copy semua data dari table asset_upload ke table assets
     */
    public function copyFromUpload()
    {
        try {
            // Ambil semua data dari asset_upload
            $uploadedAssets = AssetUpload::all();

            if ($uploadedAssets->isEmpty()) {
                return redirect()->route('assets.index')->with('error', 'Tidak ada data yang bisa dicopy dari asset_upload.');
            }

            $copiedCount = 0;
            $errors = [];

            foreach ($uploadedAssets as $uploadedAsset) {
                try {
                    // Mapping data dari asset_upload ke assets (struktur sama)
                    $assetData = [
                        'asset_no' => $uploadedAsset->asset_no,
                        'description' => $uploadedAsset->description,
                        'dept' => $uploadedAsset->dept,
                        'acquisition_date' => $uploadedAsset->acquisition_date,
                        'end_date' => $uploadedAsset->end_date,
                        'voucher_aqc' => $uploadedAsset->voucher_aqc,
                        'base_price' => $uploadedAsset->base_price,
                        'accumulation_last_year' => $uploadedAsset->accumulation_last_year,
                        'ending_book_value_last_year' => $uploadedAsset->ending_book_value_last_year,
                        'dep_rate' => $uploadedAsset->dep_rate,
                        'depreciation_yearly' => $uploadedAsset->depreciation_yearly,
                        'book_value_last_month' => $uploadedAsset->book_value_last_month,
                        'depreciation_accum_depr' => $uploadedAsset->depreciation_accum_depr,
                        'depreciation_book_value' => $uploadedAsset->depreciation_book_value,
                        'user_id' => Auth::id(),
                    ];

                    // Cek apakah asset_no sudah ada
                    $existingAsset = Assets::where('asset_no', $assetData['asset_no'])->first();
                    if ($existingAsset) {
                        $errors[] = "Asset no {$assetData['asset_no']} sudah ada, dilewati.";
                        continue;
                    }

                    // Buat asset baru
                    Assets::create($assetData);
                    $copiedCount++;

                } catch (\Exception $e) {
                    $errors[] = "Error copying asset: " . $e->getMessage();
                    continue;
                }
            }

            $message = "Berhasil mencopy {$copiedCount} asset dari asset_upload.";
            if (!empty($errors)) {
                $message .= " Ada " . count($errors) . " error: " . implode(', ', $errors);
            }

            $status = $copiedCount > 0 ? 'success' : 'error';
            
            return redirect()->route('assets.index')->with($status, $message);

        } catch (\Exception $e) {
            return redirect()->route('assets.index')->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
