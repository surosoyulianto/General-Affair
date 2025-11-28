@extends('layouts.app')

@section('content')

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<div class="max-w-5xl mx-auto px-6 py-6">

    <h1 class="text-2xl font-semibold text-gray-800 mb-6">Buat Transfer Aset</h1>

    {{-- ERROR ALERT --}}
    @if ($errors->any())
        <div class="mb-4 p-4 bg-red-100 text-red-700 rounded-md">
            <strong>Error: Periksa kembali formulir.</strong>
            <ul class="mt-2 list-disc pl-6">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('asset_transfers.store') }}" method="POST">
        @csrf

        {{-- PILIH ASET --}}
        <div class="mb-6">
            <label class="block mb-1 text-sm font-medium">Pilih Aset</label>
            <select id="asset_id" name="asset_id" class="select2 w-full border-gray-300 rounded-lg" required>
                <option value="">-- Pilih Aset --</option>
                @foreach($assets as $asset)
                    <option value="{{ $asset->id }}">
                        {{ $asset->asset_number }} - {{ $asset->asset_name }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- =======================
             USER
        ======================== --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">

            {{-- USER FROM --}}
            <div>
                <label class="block text-sm font-medium mb-1">User Awal</label>
                <select id="from_user_id" name="from_user_id"
                    class="w-full border-gray-300 bg-gray-100 rounded-lg" readonly>
                    <option value="">-- Belum Ada --</option>
                    @foreach ($users as $u)
                        <option value="{{ $u->id }}">{{ $u->name }}</option>
                    @endforeach
                </select>
            </div>

            {{-- USER TO --}}
            <div>
                <label class="block text-sm font-medium mb-1">User Baru</label>
                <select id="to_user_id" name="to_user_id"
                    class="select2 w-full border-gray-300 rounded-lg" required>
                    <option value="">-- Pilih User Baru --</option>
                    @foreach ($users as $u)
                        <option value="{{ $u->id }}">{{ $u->name }}</option>
                    @endforeach
                </select>
            </div>

        </div>

        {{-- =======================
             BRANCH
        ======================== --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">

            {{-- BRANCH FROM --}}
            <div>
                <label class="block text-sm font-medium mb-1">Branch Awal</label>
                <select id="from_branch_id" name="from_branch_id"
                    class="w-full bg-gray-100 border-gray-300 rounded-lg" readonly>
                    <option value="">-- Tidak Ada --</option>
                    @foreach ($branches as $b)
                        <option value="{{ $b->id }}">{{ $b->name }}</option>
                    @endforeach
                </select>
            </div>

            {{-- BRANCH TO --}}
            <div>
                <label class="block text-sm font-medium mb-1">Branch Baru</label>
                <select id="to_branch_id" name="to_branch_id"
                    class="select2 w-full border-gray-300 rounded-lg" required>
                    <option value="">-- Pilih Branch Baru --</option>
                    @foreach ($branches as $b)
                        <option value="{{ $b->id }}">{{ $b->name }}</option>
                    @endforeach
                </select>
            </div>

        </div>

        {{-- =======================
             DEPARTMENT
        ======================== --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">

            {{-- DEPARTMENT FROM --}}
            <div>
                <label class="block text-sm font-medium mb-1">Department Awal</label>
                <select id="from_department_id" name="from_department_id"
                    class="w-full bg-gray-100 border-gray-300 rounded-lg" readonly>
                    <option value="">-- Tidak Ada --</option>
                    @foreach ($departments as $d)
                        <option value="{{ $d->id }}">{{ $d->name }}</option>
                    @endforeach
                </select>
            </div>

            {{-- DEPARTMENT TO --}}
            <div>
                <label class="block text-sm font-medium mb-1">Department Baru</label>
                <select id="to_department_id" name="to_department_id"
                    class="select2 w-full border-gray-300 rounded-lg" required>
                    <option value="">-- Pilih Department Baru --</option>
                    @foreach ($departments as $d)
                        <option value="{{ $d->id }}">{{ $d->name }}</option>
                    @endforeach
                </select>
            </div>

        </div>

        {{-- DATE --}}
        <div class="mb-6">
            <label class="block text-sm font-medium mb-1">Tanggal Transfer</label>
            <input type="date" name="transfer_date"
                value="{{ date('Y-m-d') }}"
                class="w-full border-gray-300 rounded-lg p-2" required>
        </div>

        {{-- REASON --}}
        <div class="mb-6">
            <label class="block text-sm font-medium mb-1">Alasan</label>
            <textarea name="reason" rows="3" class="w-full border-gray-300 rounded-lg p-2"></textarea>
        </div>

        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg">
            Simpan
        </button>

    </form>

</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
    $('.select2').select2();

    $('#asset_id').on('change', function () {
        let id = $(this).val();
        if (!id) return;

        $.get('/asset/detail-by-id', { asset_id: id }, function(data) {

            // USER ID
            $('#from_user_id').val(data.user_id).trigger('change');

            // MATCH BRANCH STRING → BRANCH ID
            $("#from_branch_id option").each(function(){
                if ($(this).text().trim() === data.branch) {
                    $('#from_branch_id').val($(this).val()).trigger('change');
                }
            });

            // MATCH DEPARTMENT STRING → DEPARTMENT ID
            $("#from_department_id option").each(function(){
                if ($(this).text().trim() === data.department) {
                    $('#from_department_id').val($(this).val()).trigger('change');
                }
            });

        });
    });
</script>

@endsection
