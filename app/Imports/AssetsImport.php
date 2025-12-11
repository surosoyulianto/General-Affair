<?php

namespace App\Imports;

use App\Models\AssetUpload;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithStartRow;

class AssetsImport implements ToModel, WithHeadingRow, WithStartRow
{
    public function startRow(): int
    {
        // Mulai dari baris ke-3 (baris 1 & 2 judul Excel)
        return 3;
    }

    public function model(array $row)
    {
        return new AssetUpload([
            'asset_no'                      => $this->get($row, ['asset_no', 'no_asset_no']),
            'description'                   => $this->get($row, ['description', 'deskripsi']),
            'dept'                          => $this->get($row, ['dept', 'department']),
            'acquisition_date'              => $this->get($row, ['acquisition_date', 'tanggal_perolehan']),
            'end_date'                      => $this->get($row, ['end_date', 'tanggal_akhir']),
            'voucher_aqc'                   => $this->get($row, ['voucher_aqc']),
            'base_price'                    => $this->num($row, ['base_price', 'harga']),
            'accumulation_last_year'        => $this->num($row, ['accumulation_last_year']),
            'ending_book_value_last_year'   => $this->num($row, ['ending_book_value_last_year']),
            'dep_rate'                      => $this->num($row, ['dep_rate', 'rate']),
            'depreciation_yearly'           => $this->num($row, ['depreciation_yearly']),
            'book_value_last_month'         => $this->num($row, ['book_value_last_month']),
            'depreciation_accum_depr'       => $this->num($row, ['depreciation_accum_depr']),
            'depreciation_book_value'       => $this->num($row, ['depreciation_book_value']),
        ]);
    }

    /**
     * Ambil kolom berdasarkan beberapa kemungkinan nama header.
     */
    private function get($row, array $keys)
    {
        foreach ($keys as $k) {
            if (isset($row[$k])) {
                return $row[$k];
            }
        }
        return null;
    }

    /**
     * Ambil numeric (konversi otomatis).
     */
    private function num($row, array $keys)
    {
        foreach ($keys as $k) {
            if (isset($row[$k]) && is_numeric($row[$k])) {
                return (float) $row[$k];
            }
        }
        return null;
    }
}
