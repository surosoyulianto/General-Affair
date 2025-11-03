<?php

namespace Database\Seeders;

use Exception;
use App\Models\User;
use App\Models\Branch;
use App\Models\UserDetail;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    public function run()
    {
        DB::transaction(function () {
            foreach ($this->userSeeder as $user) {
                try {
                    // 🔹 Pastikan UUID selalu ada
                    if (empty($user['uuid'])) {
                        $user['uuid'] = (string) Str::uuid();
                    }

                    // 🔹 Create or update user
                    $insertedUser = User::updateOrCreate(
                        ['email' => $user['email']],
                        [
                            'uuid' => $user['uuid'],
                            'name' => $user['name'],
                            'username' => $user['username'],
                            'password' => Hash::make($user['password']),
                            'email_verified_at' => now(),
                            'remember_token' => Str::random(10),
                            'status' => 1,
                        ]
                    );

                    // 🔹 Get branch id (optional)
                    $branch = Branch::where('karep_code', $user['karep_code'])->first();

                    // 🔹 Create or update user detail
                    UserDetail::updateOrCreate(
                        ['user_id' => $insertedUser->id],
                        [
                            'branch_id' => $branch->id ?? null,
                            'department_id' => $user['department_id'] ?? null,
                            'position' => $user['position'] ?? null,
                            'nip' => $user['nip'] ?? null,
                            'supervisor_id' => $user['supervisor_id'] ?? null,
                        ]
                    );

                    // 🔹 Ensure roles exist and assign them
                    foreach ($user['roles'] as $roleName) {
                        Role::findOrCreate($roleName);
                    }

                    $insertedUser->syncRoles($user['roles']);

                    $this->command->info("✅ User {$user['name']} seeded successfully.");

                } catch (Exception $e) {
                    $this->command->error("❌ Error seeding user {$user['name']}: {$e->getMessage()}");
                }
            }
        });
    }

    /**
     * 🔸 Daftar user yang akan di-seed.
     */
    protected $userSeeder = [
        [
            'nip' => 'H.031.120B.454',
            'name' => 'HARTONO GANDASUTEDJA',
            'karep_code' => 'KPNO',
            'email' => 'hartono.gandasutedja@equityfinance.co.id',
            'username' => 'hartono.gandasutedja',
            'password' => 'hartono.gandasutedja@2024',
            'roles' => ['policy.user.head_office', 'policy.user.extended', 'approval_manual'],
            'department_id' => 1,
            'position' => 'PRESDIR',
        ],
        [
            'nip' => 'A.109.120B.899',
            'name' => 'ARRESTO ARIO',
            'karep_code' => 'KPNO',
            'email' => 'arresto.ario@equityfinance.co.id',
            'username' => 'arresto.ario',
            'password' => 'arresto.ario@2024',
            'roles' => ['policy.user.branch', 'approval_manual'],
            'department_id' => 1,
            'position' => 'WAPERSDIR',
            'supervisor_id' => 1,
        ],
        [
            'nip' => 'A.093.120B.782',
            'name' => 'ADITYA WIBOWO',
            'karep_code' => 'KPNO',
            'email' => 'aditya.wibowo@equityfinance.co.id',
            'username' => 'aditya.wibowo',
            'password' => 'aditya.wibowo@2024',
            'roles' => ['policy.user.head_office', 'policy.user.extended', 'approval_manual'],
        ],
        [
            'nip' => 'A.098.120B.807',
            'name' => 'ARY ALIF ADHIAKSA',
            'karep_code' => 'JKP',
            'email' => 'ary.alif@equityfinance.co.id',
            'username' => 'ary.alif',
            'password' => 'ary.alif@2024',
            'roles' => ['policy.user.branch', 'policy.user.extended', 'approval_manual'],
        ],
        [
            'nip' => 'A.100.120B.818',
            'name' => 'AGUSTINUS ARDIAN PRAMUDYA',
            'karep_code' => 'SBY',
            'email' => 'agustinus.ardian@equityfinance.co.id',
            'username' => 'agustinus.ardian',
            'password' => 'agustinus.ardian@2024',
            'roles' => ['policy.user.branch', 'policy.user.extended'],
        ],
        [
            'nip' => 'B.005.120B.173',
            'name' => 'BAMBANG SURJANTO',
            'karep_code' => 'KPNO',
            'email' => 'bavo@equityfinance.co.id',
            'username' => 'bavo',
            'password' => 'bavo@2024',
            'roles' => ['policy.user.head_office', 'policy.user.extended', 'approval_manual'],
            'department_id' => 15,
            'position' => 'GM',
            'supervisor_id' => 2,
        ],
        [
            'nip' => 'B.016.120B.583',
            'name' => 'BENY WRISTA BAYU PUTRA',
            'karep_code' => 'SBY',
            'email' => 'beny.wrista@equityfinance.co.id',
            'username' => 'beny.wrista',
            'password' => 'beny.wrista@2024',
            'roles' => ['policy.user.branch', 'approval_manual'],
        ],
        [
            'nip' => 'D.048.120B.689',
            'name' => 'DEVIN DITYA ANGGADA',
            'karep_code' => 'KPNO',
            'email' => 'devin.da@equityfinance.co.id',
            'username' => 'devin.da',
            'password' => 'devin.da@2024',
            'roles' => ['policy.user.head_office', 'policy.user.extended'],
        ],
        [
            'nip' => 'E.026.120B.456',
            'name' => 'ERWAN DWI PURNOMO',
            'karep_code' => 'KPNO',
            'email' => 'erwan.purnomo@equityfinance.co.id',
            'username' => 'erwan.purnomo',
            'password' => 'erwan.purnomo@2024',
            'roles' => ['policy.user.head_office', 'policy.user.extended', 'approval_manual'],
            'department_id' => 8,
            'position' => 'DGMB',
        ],
    ];
}
