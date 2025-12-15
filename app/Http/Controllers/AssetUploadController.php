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
    public function index(Request $request)
    {
        $query = AssetUpload::query();

        // SEARCH
        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('asset_no', 'ilike', "%{$search}%")
                    ->orWhere('description', 'ilike', "%{$search}%");
            });
        }

        $asset_uploads = $query
            ->orderBy('asset_no', 'asc')
            ->paginate(10)
            ->withQueryString(); // supaya search tetap saat pagination

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

            return response()->json([
                'success' => true,
                'redirect' => route('asset_uploads.index'),
                'message' => 'Data asset berhasil diupload dan disimpan ke database.'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 422);
        }
    }
}
