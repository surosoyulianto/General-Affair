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

    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white shadow rounded p-4">
        <table class="w-full border-collapse">
            <thead>
                <tr class="bg-gray-100 text-left">
                    <th class="p-2">No</th>
                    <th class="p-2">Nomor Asset</th>

                    {{-- USER --}}
                    <th class="p-2">Dari User</th>
                    <th class="p-2">Ke User</th>

                    {{-- BRANCH --}}
                    <th class="p-2">Dari Cabang</th>
                    <th class="p-2">Ke Cabang</th>

                    {{-- DEPARTMENT --}}
                    <th class="p-2">Dari Departemen</th>
                    <th class="p-2">Ke Departemen</th>

                    <th class="p-2">Tanggal Transfer</th>
                    <th class="p-2 text-center">Aksi</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($transfers as $transfer)
                    <tr class="border-b">
                        <td class="p-2">{{ $loop->iteration }}</td>

                        {{-- NOMOR ASSET --}}
                        <td class="p-2">
                            {{ $transfer->asset->asset_number ?? 'N/A' }}
                        </td>

                        {{-- USER --}}
                        <td class="p-2">{{ $transfer->fromUser->name ?? '-' }}</td>
                        <td class="p-2">{{ $transfer->toUser->name ?? '-' }}</td>

                        {{-- CABANG --}}
                        <td class="p-2">{{ $transfer->fromBranch->branch_name ?? '-' }}</td>
                        <td class="p-2">{{ $transfer->toBranch->branch_name ?? '-' }}</td>

                        {{-- DEPARTEMEN --}}
                        <td class="p-2">{{ $transfer->fromDepartment->department_name ?? '-' }}</td>
                        <td class="p-2">{{ $transfer->toDepartment->department_name ?? '-' }}</td>

                        <td class="p-2">{{ $transfer->transfer_date }}</td>

                        <td class="p-2 text-center">
                            <a href="{{ route('asset_transfers.show', $transfer->id) }}"
                               class="text-blue-600">Detail</a>
                            |
                            <a href="{{ route('asset_transfers.edit', $transfer->id) }}"
                               class="text-yellow-600">Edit</a>
                            |
                            <form action="{{ route('asset_transfers.destroy', $transfer->id) }}"
                                  method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button onclick="return confirm('Hapus data ini?')"
                                        class="text-red-600">
                                    Hapus
                                </button>
                            </form>
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
