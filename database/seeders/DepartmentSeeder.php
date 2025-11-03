<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class DepartmentSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    $departments = [
      ['name' => 'BOARD OF DIRECTOR', 'directorate' => 'DIREKSI', 'code' => 'DIR', 'is_branch' => false],
      ['name' => 'MARKETING', 'directorate' => 'BISNIS', 'code' => 'MKT', 'is_branch' => false],
      ['name' => 'CREDIT ANALYST', 'directorate' => 'BISNIS', 'code' => 'CA', 'is_branch' => false],
      ['name' => 'ACCOUNT RECEIVEABLE MANAGEMENT', 'directorate' => 'BISNIS', 'code' => 'ARM', 'is_branch' => false],
      ['name' => 'ASSET MANAGEMENT UNIT', 'directorate' => 'BISNIS', 'code' => 'AMU', 'is_branch' => false],
      ['name' => 'MANAGEMENT INFORMATION SYSTEM', 'directorate' => 'BISNIS', 'code' => 'MIS', 'is_branch' => false],
      ['name' => 'IT DEVELOPMENT', 'directorate' => 'BISNIS', 'code' => 'ITD', 'is_branch' => false],
      ['name' => 'HUMAN CAPITAL', 'directorate' => 'OPERATION', 'code' => 'HC', 'is_branch' => false],
      ['name' => 'GENERAL AFFAIR', 'directorate' => 'OPERATION', 'code' => 'GA', 'is_branch' => false],
      ['name' => 'MARKETING COMMUNICATION', 'directorate' => 'OPERATION', 'code' => 'MCO', 'is_branch' => false],
      ['name' => 'LEGAL & LITIGATION', 'directorate' => 'OPERATION', 'code' => 'LGL', 'is_branch' => false],
      ['name' => 'SYSTEM & PROCEDURE', 'directorate' => 'OPERATION', 'code' => 'SYR', 'is_branch' => false],
      ['name' => 'FINANCE & TREASURY', 'directorate' => 'FINANCE & IT', 'code' => 'FIN', 'is_branch' => false],
      ['name' => 'ACCOUNTING & TAX', 'directorate' => 'FINANCE & IT', 'code' => 'ACT', 'is_branch' => false],
      ['name' => 'IT OPERATION', 'directorate' => 'FINANCE & IT', 'code' => 'ITO', 'is_branch' => false],
      ['name' => 'RISK MANAGEMENT', 'directorate' => 'UNDER PRESDIR', 'code' => 'RM', 'is_branch' => false],
      ['name' => 'INTERNAL AUDIT & ANTI FRAUD', 'directorate' => 'UNDER PRESDIR', 'code' => 'IA', 'is_branch' => false],
      // Branch Department
      ['name' => 'MARKETING', 'directorate' => 'BRANCH', 'code' => 'BR_MKT', 'is_branch' => true],
      ['name' => 'OPERATION', 'directorate' => 'OPERATION', 'code' => 'BR_OP', 'is_branch' => true],
      ['name' => 'ACCOUNTING', 'directorate' => 'OPERATION', 'code' => 'BR_ACC', 'is_branch' => true],
      ['name' => 'FINANCE', 'directorate' => 'OPERATION', 'code' => 'BR_FIN', 'is_branch' => true],
      ['name' => 'LEGAL', 'directorate' => 'OPERATION', 'code' => 'BR_LGL', 'is_branch' => true],
    ];

    foreach ($departments as $dept) {
      DB::table('departments')->updateOrInsert(
        ['code' => $dept['code']],
        $dept
      );
    }
  }
}