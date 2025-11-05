<?php

namespace Database\Seeders;

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
                    // Generate UUID jika tidak ada
                    if (empty($user['uuid'])) {
                        $user['uuid'] = (string) Str::uuid();
                    }

                    // Buat atau update user
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

                    // Ambil branch berdasarkan karep_code
                    $branch = Branch::where('karep_code', $user['karep_code'])->first();

                    // Buat atau update UserDetail
                    UserDetail::updateOrCreate(
                        ['user_id' => $insertedUser->id],
                        [
                            'branch_id' => $branch->id ?? ($user['branch_id'] ?? null),
                            'department_id' => $user['department_id'] ?? null,
                            'position' => $user['position'] ?? null,
                            'nip' => $user['nip'] ?? null,
                            'supervisor_id' => $user['supervisor_id'] ?? null,
                        ]
                    );

                    // Buat role jika belum ada
                    if (!empty($user['roles'])) {
                        foreach ($user['roles'] as $roleName) {
                            Role::findOrCreate($roleName);
                        }
                        $insertedUser->syncRoles($user['roles']);
                    }

                } catch (\Exception $e) {
                    // Bisa dicatat ke log jika perlu
                    info('UserSeeder error: ' . $e->getMessage());
                }
            }
        });
    }

    protected $userSeeder = [
        ['nip' => 'H.031.120B.454', 'name' => 'HARTONO GANDASUTEDJA', 'karep_code' => 'KPNO', 'email' => 'hartono.gandasutedja@equityfinance.co.id', 'username' => 'hartono.gandasutedja', 'password' => 'hartono.gandasutedja@2024', 'roles' => ['policy.user.head_office', 'policy.user.extended', 'approval_manual'], 'branch_id' => '1', 'department_id' => 1, 'position' => 'PRESDIR'],
        ['nip' => 'A.109.120B.899', 'name' => 'ARRESTO ARIO', 'karep_code' => 'KPNO', 'email' => 'arresto.ario@equityfinance.co.id', 'username' => 'arresto.ario', 'password' => 'arresto.ario@2024', 'roles' => ['policy.user.branch', 'approval_manual'], 'branch_id' => '1', 'department_id' => '1', 'position' => 'WAPERSDIR', 'supervisor_id' => '1'],
        ['nip' => 'A.093.120B.782', 'name' => 'ADITYA WIBOWO', 'karep_code' => 'KPNO', 'email' => 'aditya.wibowo@equityfinance.co.id', 'username' => 'aditya.wibowo', 'password' => 'aditya.wibowo@2024', 'roles' => ['policy.user.head_office', 'policy.user.extended', 'approval_manual'], 'branch_id' => '1', 'department_id' => '9', 'position' => 'AR STAFF'],
        ['nip' => 'A.098.120B.807', 'name' => 'ARY ALIF ADHIAKSA', 'karep_code' => 'JKP', 'email' => 'ary.alif@equityfinance.co.id', 'username' => 'ary.alif', 'password' => 'ary.alif@2024', 'roles' => ['policy.user.branch', 'policy.user.extended', 'approval_manual']],
        ['nip' => 'A.100.120B.818', 'name' => 'AGUSTINUS ARDIAN PRAMUDYA', 'karep_code' => 'SBY', 'email' => 'agustinus.ardian@equityfinance.co.id', 'username' => 'agustinus.ardian', 'password' => 'agustinus.ardian@2024', 'roles' => ['policy.user.branch', 'policy.user.extended']],
        ['nip' => 'B.005.120B.173', 'name' => 'BAMBANG SURJANTO', 'karep_code' => 'KPNO', 'email' => 'bavo@equityfinance.co.id', 'username' => 'bavo', 'password' => 'bavo@2024', 'roles' => ['policy.user.head_office', 'policy.user.extended', 'approval_manual'], 'department_id' => 15, 'position' => 'GM', 'supervisor_id' => '2'],
        ['nip' => 'B.016.120B.583', 'name' => 'BENY WRISTA BAYU PUTRA', 'karep_code' => 'SBY', 'email' => 'beny.wrista@equityfinance.co.id', 'username' => 'beny.wrista', 'password' => 'beny.wrista@2024', 'roles' => ['policy.user.branch', 'approval_manual']],
        ['nip' => 'D.048.120B.689', 'name' => 'DEVIN DITYA ANGGADA', 'karep_code' => 'KPNO', 'email' => 'devin.da@equityfinance.co.id', 'username' => 'devin.da', 'password' => 'devin.da@2024', 'roles' => ['policy.user.head_office', 'policy.user.extended'], 'branch_id' => '1', 'department_id' => '7', 'position' => 'DIREKTUR', 'supervisor_id' => '1'],
        ['nip' => 'E.026.120B.456', 'name' => 'ERWAN DWI PURNOMO', 'karep_code' => 'KPNO', 'email' => 'erwan.purnomo@equityfinance.co.id', 'username' => 'erwan.purnomo', 'password' => 'erwan.purnomo@2024', 'roles' => ['policy.user.head_office', 'policy.user.extended', 'approval_manual'], 'branch_id' => '1', 'department_id' => '8', 'position' => 'DGMB'],
        ['nip' => 'P.002.120B.079', 'name' => 'PITONO', 'karep_code' => 'KPNO', 'email' => 'pitono@equityfinance.co.id', 'username' => 'pitono', 'password' => 'pitono@2024', 'roles' => ['policy.user.head_office', 'policy.user.extended', 'approval_manual'], 'branch_id' => '1', 'department_id' => '14', 'position' => 'ASSISTANT ACCOUNTING MANAGER', 'supervisor_id' => '1'],
        ['nip' => 'P.003.120B.155', 'name' => 'PRASETIATI PURNAMANINGSIH', 'karep_code' => 'KPNO', 'email' => 'prasetiati@equityfinance.co.id', 'username' => 'prasetiati', 'password' => 'prasetiati@2024', 'roles' => ['policy.user.head_office', 'policy.user.extended', 'approval_manual'], 'branch_id' => '1', 'department_id' => '15', 'position' => 'Manager IT Operation', 'supervisor_id' => '6'],
        ['nip' => 'R.036.120B.578', 'name' => 'RIO TANUSUBRATA', 'karep_code' => 'KPNO', 'email' => 'rio.tanusubrata@equityfinance.co.id', 'username' => 'rio.tanusubrata', 'password' => 'rio.tanusubrata@2024', 'roles' => ['policy.user.head_office', 'policy.user.extended', 'approval_manual'], 'branch_id' => '1', 'department_id' => '3', 'position' => 'CA MANAGER', 'supervisor_id' => '1'],
        ['nip' => 'R.043.120B.699', 'name' => 'RADEN AMIR SIDIQ WINATAKOESOEMA', 'karep_code' => 'KPNO', 'email' => 'amir.sidiq@equityfinance.co.id', 'username' => 'amir.sidiq', 'password' => 'amir.sidiq@2024', 'roles' => ['policy.user.head_office', 'policy.user.extended', 'approval_manual'], 'branch_id' => '1', 'department_id' => '4', 'position' => 'AR MANAGER', 'supervisor_id' => '1'],
        ['nip' => 'R.046.120B.758', 'name' => 'RUSMAN EFENDI', 'karep_code' => 'KPNO', 'email' => 'rusman.effendi@equityfinance.co.id', 'username' => 'rusman.effendi', 'password' => 'rusman.effendi@2024', 'roles' => ['policy.user.head_office', 'policy.user.extended', 'policy.editor', 'approval_manual']],
        ['nip' => 'S.087.120B.801', 'name' => 'SISCA', 'karep_code' => 'KPNO', 'email' => 'sisca@equityfinance.co.id', 'username' => 'sisca', 'password' => 'sisca@2024', 'roles' => ['policy.user.head_office', 'policy.user.extended', 'approval_manual']],
        ['nip' => 'W.008.120B.625', 'name' => 'WISNU BRATA', 'karep_code' => 'KPNO', 'email' => 'wisnu.brata@equityfinance.co.id', 'username' => 'wisnu.brata', 'password' => 'wisnu.brata@2024', 'roles' => ['policy.user.head_office', 'policy.user.extended', 'approval_manual'], 'branch_id' => '1', 'department_id' => '15', 'position' => 'FINANCE MANAGER', 'supervisor_id' => '1'],
        ['nip' => 'Y.028.120B.576', 'name' => 'YOVITA BESRUL', 'karep_code' => 'KPNO', 'email' => 'yovita.besrul@equityfinance.co.id', 'username' => 'yovita.besrul', 'password' => 'yovita.besrul@2024', 'roles' => ['policy.user.head_office', 'policy.user.extended', 'approval_manual'], 'branch_id' => '1', 'department_id' => '13', 'position' => 'HRD MANAGER', 'supervisor_id' => '1'],
        ['nip' => 'Y.033.120B.666', 'name' => 'YOHANES GALANG SUSETYAWAN', 'karep_code' => 'KPNO', 'email' => 'galang.ys@equityfinance.co.id', 'username' => 'galang.ys', 'password' => 'galang.ys@2024', 'roles' => ['superadmin'], 'branch_id' => '1', 'department_id' => '7', 'position' => 'SPV IT', 'supervisor_id' => '6'],
        ['nip' => 'S.085.120B.798', 'name' => 'SUROSO YULIANTO', 'karep_code' => 'KPNO', 'email' => 'suroso.yulianto@equityfinance.co.id', 'username' => 'suroso.yulianto', 'password' => 'suroso.yulianto@2024', 'roles' => ['superadmin'], 'branch_id' => '1', 'department_id' => '7', 'position' => 'staff IT', 'supervisor_id' => '18'],
        ['nip' => 'E.037.120B.905', 'name' => 'ERNIE WIDJAJA', 'karep_code' => 'KPNO', 'email' => 'ernie.widjaja@equityfinance.co.id', 'username' => 'ernie.widjaja', 'password' => 'ernie.widjaja@2024', 'roles' => ['policy.user.branch', 'approval_manual'], 'branch_id' => '1', 'supervisor_id' => '2', 'department_id' => '1'],
        ['nip' => 'C.006.120B.244', 'name' => 'CIPLUK ADININGTIAS', 'karep_code' => 'KPNO', 'email' => 'cipluk.adiningtyas@equityfinance.co.id', 'username' => 'cipluk.adiningtyas', 'password' => 'cipluk.adiningtyas@2024', 'roles' => ['policy.user.head_office', 'policy.user.extended', 'approval_manual'], 'branch_id' => '1', 'department_id' => '13', 'position' => 'ACCOUNTING MANAGER', 'supervisor_id' => '20'],
        ['nip' => 'A.111.120B.902', 'name' => 'ANGGIE NUGRENING TYASTUTIE', 'karep_code' => 'KPNO', 'email' => 'anggie.nugrening@equityfinance.co.id', 'username' => 'anggie.nugrening', 'password' => 'anggie.nugrening@2024', 'roles' => ['policy.user.branch', 'approval_manual'], 'branch_id' => '1', 'department_id' => '13', 'position' => 'approval_manual SUPERVISOR', 'supervisor_id' => '21'],
        ['nip' => 'D.061.120B.911', 'name' => 'DANIEL WICAKSANA', 'karep_code' => 'KPNO', 'email' => 'daniel.wicaksana@equityfinance.co.id', 'username' => 'daniel.wicaksana', 'password' => 'daniel.wicaksana@2024', 'roles' => ['policy.user.head_office', 'policy.user.extended', 'approval_manual'], 'branch_id' => '1', 'department_id' => '22', 'position' => 'DGMO', 'supervisor_id' => '2'],
        ['nip' => 'H.040.120B.627', 'name' => 'HERDIAN', 'karep_code' => 'KPNO', 'email' => 'herdian.ian@equityfinance.co.id', 'username' => 'herdian.ian', 'password' => 'herdian.ian@2024', 'roles' => ['policy.user.head_office', 'policy.user.extended', 'approval_manual'], 'branch_id' => '1', 'department_id' => '9', 'position' => 'Manager GA', 'supervisor_id' => '23'],
        ['nip' => 'P.016.120B.764', 'name' => 'PRESCILLA MAGDALENA WAAS', 'karep_code' => 'KPNO', 'email' => 'prescilla.waas@equityfinance.co.id', 'username' => 'prescilla.waas', 'password' => 'prescilla.waas@2024', 'roles' => ['policy.user.head_office', 'policy.user.extended', 'approval_manual'], 'branch_id' => '1', 'department_id' => '9', 'position' => 'Staff GA', 'supervisor_id' => '24'],
        ['nip' => 'M.075.120B.925', 'name' => 'MANCHO RESVANA', 'karep_code' => 'KPNO', 'email' => 'mancho.resvana@equityfinance.co.id', 'username' => 'mancho.resvana', 'password' => 'mancho.resvana@2024', 'roles' => ['policy.user.head_office', 'policy.user.extended', 'approval_manual'], 'branch_id' => '1', 'department_id' => '12', 'position' => 'PROCESS IMPROVEMENT MANAGER', 'supervisor_id' => '2'],
        ['nip' => 'F.035.120B.869', 'name' => 'FIFI NURKUMALA', 'karep_code' => 'KPNO', 'email' => 'fifi.nurkumala@equityfinance.co.id', 'username' => 'fifi.nurkumala', 'password' => 'fifi.nurkumala@2024', 'roles' => ['policy.user.head_office', 'policy.user.extended', 'approval_manual'], 'branch_id' => '1', 'department_id' => '12', 'position' => 'PROCESS IMPROVEMENT STAFF', 'supervisor_id' => '26'],
    ];
}
