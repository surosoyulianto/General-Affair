@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-6">

        <div class="flex items-center justify-between mb-6">
            <h1 class="text-2xl font-bold">Riwayat Pemindahan Asset</h1>

            <a href="{{ route('asset_transfers.create') }}"
                class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                + Tambah Transfer
            </a>
        </div>

        @if (session('success'))
            <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white shadow rounded p-4">
            <table class="w-full border border-gray-300 rounded-lg text-sm">
                <thead>
                    <tr class="bg-gray-100 border-b border-gray-300">
                        <th class="p-3 border-r border-gray-300">No</th>
                        <th class="p-3 border-r border-gray-300">Nomor Asset</th>

                        <th class="p-3 border-r border-gray-300">Dari User</th>
                        <th class="p-3 border-r border-gray-300">Ke User</th>

                        <th class="p-3 border-r border-gray-300">Dari Cabang</th>
                        <th class="p-3 border-r border-gray-300">Ke Cabang</th>

                        <th class="p-3 border-r border-gray-300">Dari Departemen</th>
                        <th class="p-3 border-r border-gray-300">Ke Departemen</th>

                        <th class="p-3 border-r border-gray-300">Tanggal Transfer</th>
                        <th class="p-3 text-center">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($transfers as $transfer)
                        <tr class="border-b border-gray-300 hover:bg-gray-50">
                            <td class="p-3 border-r border-gray-300">{{ $loop->iteration }}</td>
                            <td class="p-3 border-r border-gray-300">{{ $transfer->asset->asset_number ?? 'N/A' }}</td>

                            <td class="p-3 border-r border-gray-300">{{ $transfer->fromUser->name ?? '-' }}</td>
                            <td class="p-3 border-r border-gray-300">{{ $transfer->toUser->name ?? '-' }}</td>

                            <td class="p-3 border-r border-gray-300">{{ $transfer->fromBranch->name ?? '-' }}</td>
                            <td class="p-3 border-r border-gray-300">{{ $transfer->toBranch->name ?? '-' }}</td>

                            <td class="p-3 border-r border-gray-300">{{ $transfer->fromDepartment->name ?? '-' }}</td>
                            <td class="p-3 border-r border-gray-300">{{ $transfer->toDepartment->name ?? '-' }}</td>

                            <td class="p-3 border-r border-gray-300">{{ $transfer->transfer_date }}</td>

                            <td class="p-3 text-center">
                                <div class="flex items-center justify-center space-x-2">

                                    {{-- Detail --}}
                                    <a href="{{ route('asset_transfers.show', $transfer->id) }}"
                                        class="px-3 py-1 rounded-md text-sm text-white" style="background-color:#2563eb;">
                                        Detail
                                    </a>

                                    {{-- Edit (pakai inline style supaya tidak di-override) --}}
                                    <a href="{{ route('asset_transfers.edit', $transfer->id) }}"
                                        class="px-3 py-1 rounded-md text-sm text-white" style="background-color:#f59e0b;">
                                        Edit
                                    </a>

                                    {{-- Hapus --}}
                                    <form action="{{ route('asset_transfers.destroy', $transfer->id) }}" method="POST"
                                        class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" onclick="return confirm('Hapus data ini?')"
                                            class="px-3 py-1 rounded-md text-sm text-white"
                                            style="background-color:#dc2626;">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="mt-4">
                {{ $transfers->links() }}
            </div>
        </div>
    </div>
@endsection
