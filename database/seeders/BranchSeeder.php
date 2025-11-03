<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BranchSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    $branches = [
      ['name' => 'Head Office', 'branch_code' => 'KPNO', 'karep_code' => 'KPNO', 'status' => '1'],
      ['name' => 'Jakarta Selatan', 'branch_code' => 'JKS', 'karep_code' => 'JKS', 'status' => '1'],
      ['name' => 'Jakarta Utara', 'branch_code' => 'JKU', 'karep_code' => 'JKU', 'status' => '1'],
      ['name' => 'Jakarta Pusat', 'branch_code' => 'JKP', 'karep_code' => 'JKP', 'status' => '1'],
      ['name' => 'Bandung', 'branch_code' => 'BDG', 'karep_code' => 'BDG', 'status' => '1'],
      ['name' => 'Semarang', 'branch_code' => 'SMG', 'karep_code' => 'SMG', 'status' => '1'],
      ['name' => 'Solo', 'branch_code' => 'SLO', 'karep_code' => 'SLO', 'status' => '1'],
      ['name' => 'Denpasar', 'branch_code' => 'DPS', 'karep_code' => 'DPS', 'status' => '1'],
      ['name' => 'Surabaya', 'branch_code' => 'SBY', 'karep_code' => 'SBY', 'status' => '1'],
      ['name' => 'Medan', 'branch_code' => 'MDN', 'karep_code' => 'MDN', 'status' => '1'],
      ['name' => 'Palembang', 'branch_code' => 'PLG', 'karep_code' => 'PLG', 'status' => '1'],
      ['name' => 'Samarinda', 'branch_code' => 'SMR', 'karep_code' => 'SMR', 'status' => '1'],
      ['name' => 'Pekanbaru', 'branch_code' => 'PBR', 'karep_code' => 'PBR', 'status' => '1'],
      ['name' => 'Malang', 'branch_code' => 'MLG', 'karep_code' => 'MLG', 'status' => '1'],
      ['name' => 'Karep Dago', 'branch_code' => 'BDG', 'karep_code' => 'DGO', 'status' => '1'],
      ['name' => 'Karep Gianyar', 'branch_code' => 'BDG', 'karep_code' => 'GIA', 'status' => '0'],
      ['name' => 'Karep Alam Sutera', 'branch_code' => 'JKU', 'karep_code' => 'BSD', 'status' => '1'],
      ['name' => 'Karep Tabanan', 'branch_code' => 'SMG', 'karep_code' => 'TAB', 'status' => '0'],
      ['name' => 'Karep Semarang', 'branch_code' => 'SMG', 'karep_code' => 'SMG1', 'status' => '0'],
      ['name' => 'Karep Bekasi', 'branch_code' => 'JKS', 'karep_code' => 'BKS', 'status' => '0'],
      ['name' => 'Karep Metro', 'branch_code' => 'PLG', 'karep_code' => 'MTR', 'status' => '1'],
      ['name' => 'Karep Tuban', 'branch_code' => 'SBY', 'karep_code' => 'TUB', 'status' => '1'],
      ['name' => 'Karep Pemuda', 'branch_code' => 'SMG', 'karep_code' => 'PMD', 'status' => '0'],
      ['name' => 'Karep Kediri', 'branch_code' => 'SBY', 'karep_code' => 'KDR', 'status' => '0'],
      ['name' => 'Karep Makassar', 'branch_code' => 'SBY', 'karep_code' => 'MKS', 'status' => '0'],
    ];

    foreach ($branches as $branch) {
      DB::table('branches')->updateOrInsert(
        ['karep_code' => $branch['karep_code']],
        $branch
      );
    }
  }
}
