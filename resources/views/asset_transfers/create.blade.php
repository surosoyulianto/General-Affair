@extends('layouts.app')

@section('content')

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <style>
        /* ---------- ODOO FORM STYLE ---------- */
        .odoo-box {
            background: #fff;
            border: 1px solid #e3e6ea;
            border-radius: 8px;
            padding: 25px;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.04);
        }

        label {
            font-size: 13px;
            font-weight: 500;
            color: #505050;
            margin-bottom: 5px;
            display: block;
        }

        input[type="date"],
        textarea,
        select {
            height: 42px !important;
            padding: 6px 10px !important;
            border-radius: 7px !important;
            border: 1px solid #cfd4d9 !important;
            font-size: 14px;
            background: #fff;
        }

        textarea {
            min-height: 100px !important;
        }

        /* Select2 fix */
        .select2-container .select2-selection--single {
            height: 42px !important;
            border-radius: 7px !important;
            border: 1px solid #cfd4d9 !important;
            padding-left: 8px;
            display: flex;
            align-items: center;
        }

        .select2-container .select2-selection__rendered {
            line-height: 40px !important;
            font-size: 14px;
        }

        .select2-container .select2-selection__arrow {
            height: 42px !important;
        }

        /* Odoo style button */
        .odoo-btn {
            background: #4a67d6;
            padding: 10px 20px;
            font-size: 14px;
            border-radius: 7px;
            color: white;
            transition: 0.2s;
        }

        .odoo-btn:hover {
            background: #3b55b8;
        }
    </style>

    <div class="max-w-5xl mx-auto px-6 py-6">
        <h1 class="text-2xl font-semibold text-gray-800 mb-4">Buat Transfer Aset</h1>

        <div class="odoo-box">

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
                    <label>Pilih Aset</label>
                    <select id="asset_id" name="asset_id" class="select2 w-full" required>
                        <option value="">-- Pilih Aset --</option>
                        @foreach ($assets as $asset)
                            <option value="{{ $asset->id }}">
                                {{ $asset->asset_number }} - {{ $asset->asset_name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- USER --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">

                    <div>
                        <label>User Awal</label>
                        <select id="from_user_id" name="from_user_id" class="w-full bg-gray-100" readonly>
                            <option value="">-- Belum Ada --</option>
                            @foreach ($users as $u)
                                <option value="{{ $u->id }}">{{ $u->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label>User Baru</label>
                        <select id="to_user_id" name="to_user_id" class="select2 w-full" required>
                            <option value="">-- Pilih User Baru --</option>
                            @foreach ($users as $u)
                                <option value="{{ $u->id }}">{{ $u->name }}</option>
                            @endforeach
                        </select>
                    </div>

                </div>

                {{-- BRANCH --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">

                    <div>
                        <label>Branch Awal</label>
                        <select id="from_branch_id" name="from_branch_id" class="w-full bg-gray-100" readonly>
                            <option value="">-- Tidak Ada --</option>
                            @foreach ($branches as $b)
                                <option value="{{ $b->id }}">{{ $b->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label>Branch Baru</label>
                        <select id="to_branch_id" name="to_branch_id" class="select2 w-full" required>
                            <option value="">-- Pilih Branch Baru --</option>
                            @foreach ($branches as $b)
                                <option value="{{ $b->id }}">{{ $b->name }}</option>
                            @endforeach
                        </select>
                    </div>

                </div>

                {{-- DEPARTMENT --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">

                    <div>
                        <label>Department Awal</label>
                        <select id="from_department_id" name="from_department_id" class="w-full bg-gray-100" readonly>
                            <option value="">-- Tidak Ada --</option>
                            @foreach ($departments as $d)
                                <option value="{{ $d->id }}">{{ $d->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label>Department Baru</label>
                        <select id="to_department_id" name="to_department_id" class="select2 w-full" required>
                            <option value="">-- Pilih Department Baru --</option>
                            @foreach ($departments as $d)
                                <option value="{{ $d->id }}">{{ $d->name }}</option>
                            @endforeach
                        </select>
                    </div>

                </div>

                {{-- DATE --}}
                <div class="mb-6">
                    <label>Tanggal Transfer</label>
                    <input type="date" name="transfer_date" value="{{ date('Y-m-d') }}" class="w-full" required>
                </div>

                {{-- REASON --}}
                <div class="mb-6">
                    <label>Alasan</label>
                    <textarea name="reason" class="w-full"></textarea>
                </div>

                <button type="submit" class="odoo-btn">
                    Simpan
                </button>

            </form>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        $('.select2').select2();

        $('#asset_id').on('change', function() {
            let id = $(this).val();
            if (!id) return;

            $.get('/asset/detail-by-id', {
                asset_id: id
            }, function(data) {

                $('#from_user_id').val(data.user_id).trigger('change');

                $('#from_branch_id').val(data.branch_id).trigger('change');
                
                $('#from_department_id').val(data.department_id).trigger('change');

            });
        });
    </script>

@endsection
