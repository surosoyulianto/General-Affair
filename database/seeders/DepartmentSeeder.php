<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DepartmentSeeder extends Seeder
{
    public function run(): void
    {
        $departments = [
            ['id' => 1,  'name' => 'BOARD OF DIRECTOR', 'directorate' => 'DIREKSI', 'code' => 'DIR', 'is_branch' => false],
            ['id' => 2,  'name' => 'MARKETING', 'directorate' => 'BISNIS', 'code' => 'MKT', 'is_branch' => false],
            ['id' => 3,  'name' => 'CREDIT ANALYST', 'directorate' => 'BISNIS', 'code' => 'CA', 'is_branch' => false],
            ['id' => 4,  'name' => 'ACCOUNT RECEIVEABLE MANAGEMENT', 'directorate' => 'BISNIS', 'code' => 'ARM', 'is_branch' => false],
            ['id' => 5,  'name' => 'ASSET MANAGEMENT UNIT', 'directorate' => 'BISNIS', 'code' => 'AMU', 'is_branch' => false],
            ['id' => 6,  'name' => 'MANAGEMENT INFORMATION SYSTEM', 'directorate' => 'BISNIS', 'code' => 'MIS', 'is_branch' => false],
            ['id' => 7,  'name' => 'IT DEVELOPMENT', 'directorate' => 'BISNIS', 'code' => 'ITD', 'is_branch' => false],
            ['id' => 8,  'name' => 'HUMAN CAPITAL', 'directorate' => 'OPERATION', 'code' => 'HC', 'is_branch' => false],
            ['id' => 9,  'name' => 'GENERAL AFFAIR', 'directorate' => 'OPERATION', 'code' => 'GA', 'is_branch' => false],
            ['id' => 10, 'name' => 'MARKETING COMMUNICATION', 'directorate' => 'OPERATION', 'code' => 'MCO', 'is_branch' => false],
            ['id' => 11, 'name' => 'LEGAL & LITIGATION', 'directorate' => 'OPERATION', 'code' => 'LGL', 'is_branch' => false],
            ['id' => 12, 'name' => 'SYSTEM & PROCEDURE', 'directorate' => 'OPERATION', 'code' => 'SYR', 'is_branch' => false],
            ['id' => 13, 'name' => 'FINANCE & TREASURY', 'directorate' => 'FINANCE & IT', 'code' => 'FIN', 'is_branch' => false],
            ['id' => 14, 'name' => 'ACCOUNTING & TAX', 'directorate' => 'FINANCE & IT', 'code' => 'ACT', 'is_branch' => false],
            ['id' => 15, 'name' => 'IT OPERATION', 'directorate' => 'FINANCE & IT', 'code' => 'ITO', 'is_branch' => false],
            ['id' => 16, 'name' => 'RISK MANAGEMENT', 'directorate' => 'UNDER PRESDIR', 'code' => 'RM', 'is_branch' => false],
            ['id' => 17, 'name' => 'INTERNAL AUDIT & ANTI FRAUD', 'directorate' => 'UNDER PRESDIR', 'code' => 'IA', 'is_branch' => false],
            ['id' => 18, 'name' => 'MARKETING', 'directorate' => 'BRANCH', 'code' => 'BR_MKT', 'is_branch' => true],
            ['id' => 19, 'name' => 'OPERATION', 'directorate' => 'BRANCH', 'code' => 'BR_OP', 'is_branch' => true],
            ['id' => 20, 'name' => 'ACCOUNTING', 'directorate' => 'BRANCH', 'code' => 'BR_ACC', 'is_branch' => true],
            ['id' => 21, 'name' => 'FINANCE', 'directorate' => 'BRANCH', 'code' => 'BR_FIN', 'is_branch' => true],
            ['id' => 22, 'name' => 'LEGAL', 'directorate' => 'BRANCH', 'code' => 'BR_LGL', 'is_branch' => true],
        ];

        foreach ($departments as $dept) {
            DB::table('departments')->updateOrInsert(
                ['id' => $dept['id']],
                $dept
            );
        }
    }
}
