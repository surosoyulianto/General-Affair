<?php

namespace App\Http\Controllers;

use App\Imports\AssetsImport;
use App\Models\AssetUpload;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class AssetUploadController extends Controller
{
    /**
     * Tampilkan form upload file Excel.
     */
    public function index()
    {
        // ambil semua data dari table asset_upload (model harus menunjuk ke table asset_upload)
        $asset_uploads = AssetUpload::latest()->get();

        return view('asset_uploads.index', compact('asset_uploads'));
    }

    /**
     * Proses upload dan import file Excel.
     */
    public function store(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls',
        ]);

        try {
            Excel::import(new AssetsImport, $request->file('file'));

            // Check if request is AJAX
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Data asset berhasil diupload dan disimpan ke database.'
                ]);
            }

            return redirect()->route('asset_uploads.index')->with('success', 'Data asset berhasil diupload dan disimpan ke database.');
        } catch (\Exception $e) {
            // Check if request is AJAX
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Terjadi kesalahan saat mengupload file: ' . $e->getMessage()
                ], 422);
            }

            return redirect()->route('asset_uploads.index')->with('error', 'Terjadi kesalahan saat mengupload file: ' . $e->getMessage());
        }
    }
}
