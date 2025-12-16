@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto px-6 py-6">

        {{-- Header --}}
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-2xl font-semibold text-gray-800">Daftar Asset</h1>

            {{-- Tombol-tombol --}}
            <div class="flex items-center gap-4">
                {{-- Tombol Copy Asset --}}
                <form action="{{ route('assets.copy-from-upload') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" onclick="this.disabled=true; this.form.submit();"
                        class="inline-flex items-center gap-2 bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg shadow transition">
                        Copy Asset
                    </button>
                </form>
            </div>
        </div>

        {{-- Notifikasi sukses --}}
        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        {{-- Notifikasi error --}}
        @if (session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                {{ session('error') }}
            </div>
        @endif

        {{-- Tabel daftar asset --}}
        <div class="bg-white shadow rounded-lg overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 text-sm">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-2 text-left">No.</th>
                        <th class="px-4 py-2 text-left">Asset No</th>
                        <th class="px-4 py-2 text-left">Description</th>
                        <th class="px-4 py-2 text-left">Department</th>
                        <th class="px-4 py-2 text-left">Acquisition Date</th>
                        <th class="px-4 py-2 text-left">End Date</th>
                        <th class="px-4 py-2 text-left">Voucher Aqc</th>
                        <th class="px-4 py-2 text-left">Base Price</th>
                        <th class="px-4 py-2 text-left">Accumulation Last Year</th>
                        <th class="px-4 py-2 text-left">Ending Book Value Last Year</th>
                        <th class="px-4 py-2 text-left">Dep Rate</th>
                        <th class="px-4 py-2 text-left">Depreciation Yearly</th>
                        <th class="px-4 py-2 text-left">Book Value Last Month</th>
                        <th class="px-4 py-2 text-left">Depreciation Accum Depr</th>
                        <th class="px-4 py-2 text-left">Depreciation Book Value</th>
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

                            <td class="px-4 py-2">{{ $asset->asset_no ?? '-' }}</td>
                            <td class="px-4 py-2 truncate max-w-[200px]">{{ $asset->description ?? '-' }}</td>
                            <td class="px-4 py-2">{{ $asset->dept ?? '-' }}</td>
                            <td class="px-4 py-2">
                                {{ $asset->acquisition_date ? $asset->acquisition_date->format('d/m/Y') : '-' }}
                            </td>
                            <td class="px-4 py-2">
                                {{ $asset->end_date ? $asset->end_date->format('d/m/Y') : '-' }}
                            </td>
                            <td class="px-4 py-2">{{ $asset->voucher_aqc ?? '-' }}</td>
                            <td class="px-4 py-2">
                                {{ $asset->base_price ? number_format($asset->base_price, 2, ',', '.') : '-' }}
                            </td>
                            <td class="px-4 py-2">
                                {{ $asset->accumulation_last_year ? number_format($asset->accumulation_last_year, 2, ',', '.') : '-' }}
                            </td>
                            <td class="px-4 py-2">
                                {{ $asset->ending_book_value_last_year ? number_format($asset->ending_book_value_last_year, 2, ',', '.') : '-' }}
                            </td>
                            <td class="px-4 py-2">
                                {{ $asset->dep_rate ? number_format($asset->dep_rate, 2, ',', '.') : '-' }}
                            </td>
                            <td class="px-4 py-2">
                                {{ $asset->depreciation_yearly ? number_format($asset->depreciation_yearly, 2, ',', '.') : '-' }}
                            </td>
                            <td class="px-4 py-2">
                                {{ $asset->book_value_last_month ? number_format($asset->book_value_last_month, 2, ',', '.') : '-' }}
                            </td>
                            <td class="px-4 py-2">
                                {{ $asset->depreciation_accum_depr ? number_format($asset->depreciation_accum_depr, 2, ',', '.') : '-' }}
                            </td>
                            <td class="px-4 py-2">
                                {{ $asset->depreciation_book_value ? number_format($asset->depreciation_book_value, 2, ',', '.') : '-' }}
                            </td>
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
                            <td colspan="17" class="px-4 py-3 text-center text-gray-500">
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
