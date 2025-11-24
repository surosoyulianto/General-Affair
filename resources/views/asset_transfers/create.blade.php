@extends('layouts.app')

@section('content')

    <style>
        select option {
            color: #000 !important;
            background: #fff !important;
        }
    </style>

    <div class="max-w-5xl mx-auto px-6 py-6">

        <h1 class="text-2xl font-semibold text-gray-800 mb-6">Buat Transfer Aset</h1>

        {{-- Error message --}}
        @if ($errors->any())
            <div class="bg-red-100 text-red-800 px-4 py-3 rounded mb-6 border border-red-300">
                <strong>Error:</strong> Periksa kembali formulir Anda.
                <ul class="list-disc ml-6 mt-2">
                    @foreach ($errors->all() as $e)
                        <li>{{ $e }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('asset_transfers.store') }}" method="POST"
            class="bg-white shadow rounded-lg p-6 border border-gray-200">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                {{-- Kolom Kiri --}}
                <div class="space-y-4">

                    {{-- Nomor Asset --}}
                    <div>
                        <label class="block text-sm font-medium mb-1">Nomor Aset</label>
                        <select id="asset_id" name="asset_id"
                            class="w-full border-gray-300 rounded-md p-2 bg-white text-black" required>
                            <option value="">-- Pilih Nomor Aset --</option>
                            @foreach ($assets as $asset)
                                <option value="{{ $asset->asset_number }}">
                                    {{ $asset->asset_number }} - {{ $asset->asset_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Owner Awal --}}
                    <div>
                        <label class="block text-sm font-medium mb-1">Owner Awal</label>
                        <select id="owner_from_display" class="w-full border-gray-300 rounded-md p-2 bg-gray-100" disabled>
                            <option>-</option>
                        </select>
                        <input type="hidden" name="owner_from" id="owner_from">
                    </div>

                    {{-- Owner Baru --}}
                    <div>
                        <label class="block text-sm font-medium mb-1">Owner Baru</label>
                        <select name="owner_to" class="w-full border-gray-300 rounded-md p-2 bg-white text-black" required>
                            <option value="">-- Pilih Owner Baru --</option>
                            @foreach ($users as $u)
                                <option value="{{ $u->id }}">{{ $u->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Tanggal Transfer --}}
                    <div>
                        <label class="block text-sm font-medium mb-1">Tanggal Transfer Asset</label>
                        <input type="date" name="transfer_date"
                            class="w-full border-gray-300 rounded-md p-2 bg-white text-black" required>
                    </div>

                </div>

                {{-- Kolom Kanan --}}
                <div class="space-y-4">

                    {{-- Cabang Awal --}}
                    <div>
                        <label class="block text-sm font-medium mb-1">Cabang Awal</label>
                        <select id="branch_from_display" class="w-full border-gray-300 rounded-md p-2 bg-gray-100" disabled>
                            <option>-</option>
                        </select>
                        <input type="hidden" name="branch_from" id="branch_from">
                    </div>

                    {{-- Cabang Baru --}}
                    <div>
                        <label class="block text-sm font-medium mb-1">Cabang Baru</label>
                        <select name="branch_to" class="w-full border-gray-300 rounded-md p-2 bg-white text-black" required>
                            <option value="">-- Pilih Cabang Baru --</option>
                            @foreach ($branches as $b)
                                <option value="{{ $b->id }}">{{ $b->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Departemen Awal --}}
                    <div>
                        <label class="block text-sm font-medium mb-1">Departemen Awal</label>
                        <select id="department_from_display" class="w-full border-gray-300 rounded-md p-2 bg-gray-100"
                            disabled>
                            <option>-</option>
                        </select>
                        <input type="hidden" name="department_from" id="department_from">
                    </div>

                    {{-- Departemen Baru --}}
                    <div>
                        <label class="block text-sm font-medium mb-1">Departemen Baru</label>
                        <select name="department_to" class="w-full border-gray-300 rounded-md p-2 bg-white text-black"
                            required>
                            <option value="">-- Pilih Departemen Baru --</option>
                            @foreach ($departments as $d)
                                <option value="{{ $d->id }}">{{ $d->name }}</option>
                            @endforeach
                        </select>
                    </div>

                </div>

            </div>

            {{-- Keterangan --}}
            <div class="mt-4">
                <label class="block text-sm font-medium mb-1">Keterangan</label>
                <textarea name="notes" rows="3" class="w-full border-gray-300 rounded-md p-2"></textarea>
            </div>

            {{-- Tombol --}}
            <div class="flex gap-3 mt-6">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md">Simpan</button>
                <a href="{{ route('asset_transfers.index') }}"
                    class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-md">Batal</a>
            </div>

        </form>
    </div>

    {{-- ================== AJAX SCRIPT ================== --}}
    <script>
        document.getElementById('asset_id').addEventListener('change', function() {
            let assetNumber = this.value; 

            if (!assetNumber) return;

            fetch('/asset/detail-by-number/' + assetNumber)
                .then(res => res.json())
                .then(data => {
                    // OWNER
                    document.getElementById('owner_from_display').innerHTML =
                        `<option>${data.user?.name ?? '-'}</option>`;
                    document.getElementById('owner_from').value = data.user_id ?? '';

                    // CABANG
                    document.getElementById('branch_from_display').innerHTML =
                        `<option>${data.branch_relation?.name ?? '-'}</option>`;
                    document.getElementById('branch_from').value = data.branch ?? '';

                    // DEPARTEMEN
                    document.getElementById('department_from_display').innerHTML =
                        `<option>${data.department_relation?.name ?? '-'}</option>`;
                    document.getElementById('department_from').value = data.department ?? '';
                });
        });
    </script>
@endsection
