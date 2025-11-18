@extends('layouts.app')

@section('content')

{{-- FIX GLOBAL UNTUK DROPDOWN PUTIH --}}
<style>
    select option {
        color: black !important;
        background: white !important;
    }
</style>

<div class="container mx-auto px-4 py-6">

    <h1 class="text-2xl font-bold mb-4">Buat Transfer Aset</h1>

    <form action="{{ route('asset_transfers.store') }}" method="POST" class="bg-white p-6 rounded shadow">
        @csrf

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            {{-- Kolom Kiri --}}
            <div>

                {{-- Nomor Asset --}}
                <div class="mb-4">
                    <label class="block font-semibold mb-1">Nomor Aset</label>
                    <select name="asset_id" 
                        class="border rounded w-full p-2 bg-white text-black appearance-none" 
                        style="color:black !important"
                        required>
                        <option value="">-- Pilih Nomor Aset --</option>
                        @foreach ($assets as $asset)
                            <option value="{{ $asset->id }}">
                                {{ $asset->asset_number }} - {{ $asset->asset_name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Owner Dari --}}
                <div class="mb-4">
                    <label class="block font-semibold mb-1">Owner Dari</label>
                    <select name="owner_from" 
                        class="border rounded w-full p-2 bg-white text-black appearance-none" 
                        style="color:black !important"
                        required>
                        <option value="">-- Pilih Owner Awal --</option>
                        @foreach ($users as $u)
                            <option value="{{ $u->id }}">{{ $u->name }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- Owner Ke --}}
                <div class="mb-4">
                    <label class="block font-semibold mb-1">Owner Ke</label>
                    <select name="owner_to" 
                        class="border rounded w-full p-2 bg-white text-black appearance-none" 
                        style="color:black !important"
                        required>
                        <option value="">-- Pilih Owner Baru --</option>
                        @foreach ($users as $u)
                            <option value="{{ $u->id }}">{{ $u->name }}</option>
                        @endforeach
                    </select>
                </div>

            </div>

            {{-- Kolom Kanan --}}
            <div>
                {{-- Cabang Dari --}}
                <div class="mb-4">
                    <label class="block font-semibold mb-1">Cabang Dari</label>
                    <select name="branch_from" 
                        class="border rounded w-full p-2 bg-white text-black" 
                        style="color:black !important"
                        required>
                        <option value="">-- Pilih Cabang Awal --</option>
                        @foreach ($branches as $b)
                            <option value="{{ $b->id }}">{{ $b->name }} </option>
                        @endforeach
                    </select>
                </div>

                {{-- Cabang Ke --}}
                <div class="mb-4">
                    <label class="block font-semibold mb-1">Cabang Ke</label>
                    <select name="branch_to" 
                        class="border rounded w-full p-2 bg-white text-black appearance-none" 
                        style="color:black !important"
                        required>
                        <option value="">-- Pilih Cabang Baru --</option>
                        @foreach ($branches as $b)
                            <option value="{{ $b->id }}">{{ $b->name }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- Departemen Dari --}}
                <div class="mb-4">
                    <label class="block font-semibold mb-1">Departemen Dari</label>
                    <select name="department_from" 
                        class="border rounded w-full p-2 bg-white text-black appearance-none" 
                        style="color:black !important"
                        required>
                        <option value="">-- Pilih Departemen Awal --</option>
                        @foreach ($departments as $d)
                            <option value="{{ $d->id }}">{{ $d->name }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- Departemen Ke --}}
                <div class="mb-4">
                    <label class="block font-semibold mb-1">Departemen Ke</label>
                    <select name="department_to" 
                        class="border rounded w-full p-2 bg-white text-black appearance-none" 
                        style="color:black !important"
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
            <label class="block font-semibold">Keterangan</label>
            <textarea name="notes" class="border rounded w-full p-2" rows="3"></textarea>
        </div>

        {{-- Tombol --}}
        <div class="flex gap-3 mt-6">
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
                Simpan
            </button>

            <a href="{{ route('asset_transfers.index') }}" 
               class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded">
                Batal
            </a>
        </div>

    </form>
</div>
@endsection
