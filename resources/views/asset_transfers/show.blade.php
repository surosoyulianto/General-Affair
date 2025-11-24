@extends('layouts.app')

@section('content')
    <div class="max-w-4xl mx-auto px-6 py-6">

        {{-- Judul --}}
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-2xl font-semibold text-gray-800">Detail Transfer Asset</h1>

            <a href="{{ route('asset_transfers.index') }}" class="bg-gray-600 text-white px-4 py-2 rounded hover:bg-gray-700">
                Kembali
            </a>
        </div>

        {{-- Card Utama --}}
        <div class="bg-white shadow-md rounded-xl p-6">

            {{-- Header Info Asset --}}
            <div class="border-b pb-4 mb-4">
                <h2 class="text-xl font-semibold text-gray-700 mb-1">
                    {{ $transfer->asset->asset_name }}
                </h2>
                <p class="text-gray-500">
                    Nomor Asset: <span class="font-medium">{{ $transfer->asset->asset_number }}</span>
                </p>
            </div>

            {{-- Grid Informasi --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <div>
                    <h3 class="text-gray-700 font-semibold mb-2">Informasi User</h3>
                    <div class="space-y-1 text-gray-600">
                        <p><span class="font-medium">Dari User:</span> {{ $transfer->fromUser->name ?? '-' }}</p>
                        <p><span class="font-medium">Ke User:</span> {{ $transfer->toUser->name ?? '-' }}</p>
                    </div>
                </div>

                <div>
                    <h3 class="text-gray-700 font-semibold mb-2">Lokasi</h3>
                    <div class="space-y-1 text-gray-600">
                        <p><span class="font-medium">Dari Cabang:</span> {{ $transfer->fromBranch->name ?? '-' }}</p>
                        <p><span class="font-medium">Ke Cabang:</span> {{ $transfer->toBranch->name ?? '-' }}</p>
                    </div>
                </div>

                <div>
                    <h3 class="text-gray-700 font-semibold mb-2">Departemen</h3>
                    <div class="space-y-1 text-gray-600">
                        <p><span class="font-medium">Dari Departemen:</span>
                            {{ $transfer->fromDepartment->name ?? '-' }}</p>
                        <p><span class="font-medium">Ke Departemen:</span>
                            {{ $transfer->toDepartment->name ?? '-' }}</p>
                    </div>
                </div>

                <div>
                    <h3 class="text-gray-700 font-semibold mb-2">Informasi Transfer</h3>
                    <div class="space-y-1 text-gray-600">
                        <p><span class="font-medium">Tanggal Transfer:</span> {{ $transfer->transfer_date }}</p>
                        <p><span class="font-medium">Alasan:</span> {{ $transfer->reason ?? '-' }}</p>
                    </div>
                </div>

            </div>

            {{-- Tombol --}}
            {{-- Tombol --}}
            <div class="mt-6 flex space-x-3">

                <a href="{{ route('asset_transfers.edit', $transfer->id) }}"
                    class="inline-block bg-yellow-600 text-white font-semibold px-4 py-2 rounded-lg shadow hover:bg-yellow-700 transition">
                    Edit
                </a>

                <form action="{{ route('asset_transfers.destroy', $transfer->id) }}" method="POST"
                    onsubmit="return confirm('Hapus data ini?')">
                    @csrf
                    @method('DELETE')
                    <button
                        class="inline-block bg-red-600 text-white font-semibold px-4 py-2 rounded-lg shadow hover:bg-red-700 transition">
                        Hapus
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
