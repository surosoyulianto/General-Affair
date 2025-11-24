@extends('layouts.app')

@section('content')

<style>
    /* Fix dropdown putih di Chrome/Edge */
    select option {
        color: black !important;
        background: white !important;
    }
</style>

<div class="container mx-auto px-4 py-6">

    <h1 class="text-2xl font-bold mb-4">Edit Transfer Aset</h1>

    @if ($errors->any())
        <div class="bg-red-200 text-red-800 p-3 mb-4 rounded">
            <b>Error:</b> Periksa kembali formulir Anda.
            <ul class="list-disc ml-4">
                @foreach ($errors->all() as $e)
                    <li>{{ $e }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('asset_transfers.update', $transfer->id) }}" method="POST"
          class="bg-white p-6 rounded shadow">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            {{-- Kolom Kiri --}}
            <div>

                {{-- Nomor Asset --}}
                <div class="mb-4">
                    <label class="block font-semibold mb-1">Nomor Aset</label>
                    <select name="asset_id" class="border rounded w-full p-2 bg-white text-black" required>
                        @foreach ($assets as $asset)
                            <option value="{{ $asset->id }}"
                                {{ $transfer->asset_id == $asset->id ? 'selected' : '' }}>
                                {{ $asset->asset_number }} - {{ $asset->asset_name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Owner Dari --}}
                <div class="mb-4">
                    <label class="block font-semibold mb-1">Owner Dari</label>
                    <select name="from_user_id" class="border rounded w-full p-2 bg-white text-black" required>
                        @foreach ($users as $u)
                            <option value="{{ $u->id }}"
                                {{ $transfer->from_user_id == $u->id ? 'selected' : '' }}>
                                {{ $u->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Owner Ke --}}
                <div class="mb-4">
                    <label class="block font-semibold mb-1">Owner Ke</label>
                    <select name="to_user_id" class="border rounded w-full p-2 bg-white text-black" required>
                        @foreach ($users as $u)
                            <option value="{{ $u->id }}"
                                {{ $transfer->to_user_id == $u->id ? 'selected' : '' }}>
                                {{ $u->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Tanggal Transfer --}}
                <div class="mb-4">
                    <label class="block font-semibold mb-1">Tanggal Transfer</label>
                    <input type="date" name="transfer_date"
                        value="{{ $transfer->transfer_date ? date('Y-m-d', strtotime($transfer->transfer_date)) : '' }}"
                        class="border rounded w-full p-2 bg-white text-black"
                        required>
                </div>

            </div>

            {{-- Kolom Kanan --}}
            <div>

                {{-- Cabang Dari --}}
                <div class="mb-4">
                    <label class="block font-semibold mb-1">Cabang Dari</label>
                    <select name="from_branch_id" class="border rounded w-full p-2 bg-white text-black" required>
                        @foreach ($branches as $b)
                            <option value="{{ $b->id }}"
                                {{ $transfer->from_branch_id == $b->id ? 'selected' : '' }}>
                                {{ $b->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Cabang Ke --}}
                <div class="mb-4">
                    <label class="block font-semibold mb-1">Cabang Ke</label>
                    <select name="to_branch_id" class="border rounded w-full p-2 bg-white text-black" required>
                        @foreach ($branches as $b)
                            <option value="{{ $b->id }}"
                                {{ $transfer->to_branch_id == $b->id ? 'selected' : '' }}>
                                {{ $b->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Departemen Dari --}}
                <div class="mb-4">
                    <label class="block font-semibold mb-1">Departemen Dari</label>
                    <select name="from_department_id" class="border rounded w-full p-2 bg-white text-black" required>
                        @foreach ($departments as $d)
                            <option value="{{ $d->id }}"
                                {{ $transfer->from_department_id == $d->id ? 'selected' : '' }}>
                                {{ $d->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Departemen Ke --}}
                <div class="mb-4">
                    <label class="block font-semibold mb-1">Departemen Ke</label>
                    <select name="to_department_id" class="border rounded w-full p-2 bg-white text-black" required>
                        @foreach ($departments as $d)
                            <option value="{{ $d->id }}"
                                {{ $transfer->to_department_id == $d->id ? 'selected' : '' }}>
                                {{ $d->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

            </div>

        </div>

        {{-- Keterangan --}}
        <div class="mt-4">
            <label class="block font-semibold mb-1">Keterangan</label>
            <textarea name="reason" class="border rounded w-full p-2" rows="3">{{ $transfer->reason }}</textarea>
        </div>

        {{-- Tombol --}}
        <div class="flex gap-3 mt-6">
            <button type="submit" class="bg-yellow-600 hover:bg-yellow-700 text-white px-4 py-2 rounded">
                Update
            </button>

            <a href="{{ route('asset_transfers.index') }}"
               class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded">
                Batal
            </a>
        </div>

    </form>
</div>

@endsection
