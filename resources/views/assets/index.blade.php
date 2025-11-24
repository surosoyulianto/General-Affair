@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto px-6 py-6">

        {{-- Header --}}
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-2xl font-semibold text-gray-800">Daftar Asset</h1>

            {{-- Tombol Create Asset --}}
            <a href="{{ route('assets.create') }}"
                class="inline-flex items-center gap-2 bg-blue-600 text-white px-4 py-2 rounded-lg shadow hover:bg-blue-700 transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                <span>Create Asset</span>
            </a>
        </div>

        {{-- Notifikasi sukses --}}
        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        {{-- Tabel daftar asset --}}
        <div class="bg-white shadow rounded-lg overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 text-sm">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-2 text-left">No.</th>
                        <th class="px-4 py-2 text-left">Nomor Asset</th>
                        <th class="px-4 py-2 text-left">Nama Asset</th>
                        <th class="px-4 py-2 text-left">Cabang</th>
                        <th class="px-4 py-2 text-left">Departemen</th>
                        <th class="px-4 py-2 text-left">Tipe Asset</th>
                        <th class="px-4 py-2 text-left">System Info</th>
                        <th class="px-4 py-2 text-left">Brand</th>
                        <th class="px-4 py-2 text-left">Model</th>
                        <th class="px-4 py-2 text-left">Spesifikasi</th>
                        <th class="px-4 py-2 text-left">Serial Number</th>
                        <th class="px-4 py-2 text-left">Tanggal Beli</th>
                        <th class="px-4 py-2 text-left">Nilai Beli</th>
                        <th class="px-4 py-2 text-left">Lokasi</th>
                        <th class="px-4 py-2 text-left">Status</th>
                        <th class="px-4 py-2 text-left">Deskripsi</th>
                        <th class="px-4 py-2 text-left">User</th>
                        <th class="px-4 py-2 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse ($assets as $asset)
                        <tr class="hover:bg-gray-50">

                            {{-- NOMOR URUT PAGINATION --}}
                            <td class="px-4 py-2">
                                {{ ($assets->currentPage() - 1) * $assets->perPage() + $loop->iteration }}
                            </td>

                            <td class="px-4 py-2">{{ $asset->asset_number }}</td>
                            <td class="px-4 py-2">{{ $asset->asset_name ?? '-' }}</td>
                            <td class="px-4 py-2">{{ $asset->branch ?? '-' }}</td>
                            <td class="px-4 py-2">{{ $asset->department ?? '-' }}</td>
                            <td class="px-4 py-2">{{ $asset->type_asset ?? '-' }}</td>
                            <td class="px-4 py-2">{{ $asset->system_info ?? '-' }}</td>
                            <td class="px-4 py-2">{{ $asset->brand ?? '-' }}</td>
                            <td class="px-4 py-2">{{ $asset->model ?? '-' }}</td>
                            <td class="px-4 py-2">{{ $asset->specification ?? '-' }}</td>
                            <td class="px-4 py-2">{{ $asset->serial_number ?? '-' }}</td>
                            <td class="px-4 py-2">
                                {{ $asset->purchase_date ? $asset->purchase_date->format('d/m/Y') : '-' }}
                            </td>
                            <td class="px-4 py-2">
                                {{ $asset->purchase_value ? number_format($asset->purchase_value, 2, ',', '.') : '-' }}
                            </td>
                            <td class="px-4 py-2">{{ $asset->location ?? '-' }}</td>

                            {{-- STATUS --}}
                            <td class="px-4 py-2">
                                <span
                                    class="px-2 py-1 rounded text-xs 
                                {{ $asset->status === 'active' ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-700' }}">
                                    {{ ucfirst($asset->status) }}
                                </span>
                            </td>

                            <td class="px-4 py-2 truncate max-w-[200px]">{{ $asset->description ?? '-' }}</td>
                            <td class="px-4 py-2">{{ $asset->user->name ?? '-' }}</td>

                            {{-- Aksi --}}
                            <td class="p-3 text-center">
                                <div class="flex items-center justify-center space-x-2">

                                    {{-- Detail --}}
                                    <a href="{{ route('assets.show', $asset->id) }}"
                                        class="px-3 py-1 rounded-md text-sm text-white" style="background-color:#2563eb;">
                                        Lihat
                                    </a>

                                    {{-- Edit --}}
                                    <a href="{{ route('assets.edit', $asset->id) }}"
                                        class="px-3 py-1 rounded-md text-sm text-white" style="background-color:#f59e0b;">
                                        Edit
                                    </a>

                                    {{-- Hapus --}}
                                    <form action="{{ route('assets.destroy', $asset->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" onclick="return confirm('Yakin hapus asset ini?')"
                                            class="px-3 py-1 rounded-md text-sm text-white"
                                            style="background-color:#dc2626;">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="18" class="px-4 py-3 text-center text-gray-500">
                                Belum ada data asset.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        <div class="mt-4">{{ $assets->links() }}</div>
    </div>
@endsection
