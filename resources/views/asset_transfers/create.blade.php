@extends('layouts.app')

@section('content')

    {{-- Select2 CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <div class="max-w-5xl mx-auto px-6 py-6">
        <h1 class="text-2xl font-semibold text-gray-800 mb-6">Buat Transfer Aset</h1>

        {{-- Error --}}
        @if ($errors->any())
            <div class="bg-red-100 text-red-800 px-4 py-3 rounded mb-6 border border-red-300">
                <strong>Error:</strong> Periksa kembali formulir.
                <ul class="list-disc ml-6 mt-2">
                    @foreach ($errors->all() as $e)
                        <li>{{ $e }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('asset_transfers.store') }}"
              method="POST"
              class="bg-white shadow rounded-lg p-6 border border-gray-200">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                {{-- ===============================
                    KIRI
                ================================ --}}
                <div class="space-y-4">

                    {{-- Nomor Aset --}}
                    <div>
                        <label class="block text-sm font-medium mb-1">Nomor Aset</label>
                        <select id="asset_id" name="asset_id"
                                class="select2 w-full border-gray-300 rounded-md p-2 bg-white text-black" required>
                            <option value="">-- Pilih Nomor Aset --</option>
                            @foreach ($assets as $a)
                                <option value="{{ $a->asset_number }}">
                                    {{ $a->asset_number }} - {{ $a->asset_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- User Awal (DISABLED) --}}
                    <div>
                        <label class="block text-sm font-medium mb-1">User Awal</label>
                        <select id="owner_from_display"
                                class="select2 w-full border-gray-300 rounded-md p-2 bg-gray-100 text-black"
                                disabled>
                            <option value="">-- Pilih User Awal --</option>
                            @foreach ($users as $u)
                                <option value="{{ $u->id }}">{{ $u->name }}</option>
                            @endforeach
                        </select>
                        <input type="hidden" id="owner_from" name="owner_from">
                    </div>

                    {{-- User Baru --}}
                    <div>
                        <label class="block text-sm font-medium mb-1">User Baru</label>
                        <select name="user_to"
                                class="select2 w-full border-gray-300 rounded-md p-2 bg-white text-black"
                                required>
                            <option value="">-- Pilih User Baru --</option>
                            @foreach ($users as $u)
                                <option value="{{ $u->id }}">{{ $u->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Tanggal Transfer --}}
                    <div>
                        <label class="block text-sm font-medium mb-1">Tanggal Transfer Aset</label>
                        <input type="date"
                               name="transfer_date"
                               class="w-full border-gray-300 rounded-md p-2 bg-white text-black"
                               required>
                    </div>
                </div>

                {{-- ===============================
                    KANAN
                ================================ --}}
                <div class="space-y-4">

                    {{-- Cabang Awal --}}
                    <div>
                        <label class="block text-sm font-medium mb-1">Cabang Awal</label>
                        <select id="branch_from_display"
                                class="select2 w-full border-gray-300 rounded-md p-2 bg-gray-100 text-black"
                                disabled>
                            <option value="">-- Pilih Cabang Awal --</option>
                            @foreach ($branches as $b)
                                <option value="{{ $b->name }}">{{ $b->name }}</option>
                            @endforeach
                        </select>
                        <input type="hidden" id="branch_from" name="branch_from">
                    </div>

                    {{-- Cabang Baru --}}
                    <div>
                        <label class="block text-sm font-medium mb-1">Cabang Baru</label>
                        <select name="branch_to"
                                class="select2 w-full border-gray-300 rounded-md p-2 bg-white text-black" required>
                            <option value="">-- Pilih Cabang Baru --</option>
                            @foreach ($branches as $b)
                                <option value="{{ $b->name }}">{{ $b->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Departemen Awal --}}
                    <div>
                        <label class="block text-sm font-medium mb-1">Departemen Awal</label>
                        <select id="department_from_display"
                                class="select2 w-full border-gray-300 rounded-md p-2 bg-gray-100 text-black"
                                disabled>
                            <option value="">-- Pilih Departemen Awal --</option>
                            @foreach ($departments as $d)
                                <option value="{{ $d->name }}">{{ $d->name }}</option>
                            @endforeach
                        </select>
                        <input type="hidden" id="department_from" name="department_from">
                    </div>

                    {{-- Departemen Baru --}}
                    <div>
                        <label class="block text-sm font-medium mb-1">Departemen Baru</label>
                        <select name="department_to"
                                class="select2 w-full border-gray-300 rounded-md p-2 bg-white text-black" required>
                            <option value="">-- Pilih Departemen Baru --</option>
                            @foreach ($departments as $d)
                                <option value="{{ $d->name }}">{{ $d->name }}</option>
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
                <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md">
                    Simpan
                </button>

                <a href="{{ route('asset_transfers.index') }}"
                   class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-md">
                    Batal
                </a>
            </div>

        </form>
    </div>

    {{-- JS --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        $(function() {
            $('.select2').select2({
                width: '100%',
                allowClear: true
            });

            $('#asset_id').on('change', function() {
                const assetNumber = encodeURIComponent($(this).val());
                if (!assetNumber) return;

                fetch(`/asset/detail-by-number?asset_number=${assetNumber}`)
                    .then(r => r.json())
                    .then(data => {

                        // Owner
                        $('#owner_from_display').val(data.user_id || '').trigger('change');
                        $('#owner_from').val(data.user_id || '');

                        // Cabang
                        $('#branch_from_display').val(data.branch || '').trigger('change');
                        $('#branch_from').val(data.branch || '');

                        // Departemen
                        $('#department_from_display').val(data.department || '').trigger('change');
                        $('#department_from').val(data.department || '');
                    })
                    .catch(err => console.error('Fetch error:', err));
            });
        });
    </script>

@endsection
