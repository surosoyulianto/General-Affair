@extends('layouts.app')

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- Header --}}
            <div class="mb-6">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('Upload Asset Excel') }}
                </h2>
            </div>

            {{-- Upload Box --}}
            <div class="bg-white shadow-sm sm:rounded-lg mb-10">
                <div class="p-6 text-gray-900">
                    <form id="uploadForm" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-4">
                            <label for="file" class="block text-sm font-medium text-gray-700">Pilih File Excel</label>
                            <input type="file" name="file" id="file" accept=".xlsx,.xls"
                                class="mt-1 block w-full" required>
                            <p class="mt-1 text-sm text-gray-600">Format didukung: .xlsx, .xls</p>
                        </div>

                        <button type="button" id="uploadBtn"
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Upload dan Import
                        </button>
                    </form>
                </div>
            </div>

            {{-- Tabel Data --}}
            <div class="bg-white shadow-sm sm:rounded-lg">
                <div class="p-6">

                    {{-- HEADER --}}
                    <div class="flex flex-col sm:flex-row sm:justify-between mb-4 gap-2">
                        <div>
                            <h3 class="text-lg font-semibold text-gray-800">
                                Data Asset Upload
                            </h3>
                            <p class="text-sm text-gray-500">
                                Daftar asset hasil import dari file Excel
                            </p>
                        </div>

                        <div class="text-sm text-gray-500 whitespace-nowrap">
                            Total:
                            <span class="font-medium text-gray-700">
                                {{ $asset_uploads->total() }}
                            </span>
                            data
                        </div>
                    </div>

                    {{-- SEARCH --}}
                    <form method="GET" action="{{ route('asset_uploads.index') }}" class="mb-4">
                        <div class="flex flex-col sm:flex-row gap-2">

                            <input type="text" name="search" value="{{ request('search') }}"
                                placeholder="Cari kode asset..."
                                class="border border-gray-300 rounded-md px-3 py-2 w-64
                           focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-blue-400">

                            <button type="submit"
                                class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md text-sm font-medium">
                                Search
                            </button>

                            @if (request('search'))
                                <a href="{{ route('asset_uploads.index') }}"
                                    class="text-sm text-gray-500 hover:text-gray-700 hover:underline self-start">
                                    Reset
                                </a>
                            @endif

                        </div>
                    </form>

                    {{-- TABLE --}}
                    @if ($asset_uploads->count() > 0)
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-600 uppercase">No</th>
                                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-600 uppercase">Asset No
                                        </th>
                                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-600 uppercase">
                                            Description</th>
                                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-600 uppercase">Dept
                                        </th>
                                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-600 uppercase">
                                            Acquisition Date
                                        </th>
                                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-600 uppercase">Base
                                            Price</th>
                                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-600 uppercase">
                                            Book Value Last Month
                                        </th>
                                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-600 uppercase">
                                            Uploaded At
                                        </th>
                                    </tr>
                                </thead>

                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach ($asset_uploads as $index => $row)
                                        <tr>
                                            <td class="px-4 py-2">
                                                {{ $asset_uploads->firstItem() + $index }}
                                            </td>
                                            <td class="px-4 py-2">{{ $row->asset_no }}</td>
                                            <td class="px-4 py-2">{{ $row->description }}</td>
                                            <td class="px-4 py-2">{{ $row->dept }}</td>
                                            <td class="px-4 py-2">
                                                {{ $row->acquisition_date ? \Carbon\Carbon::parse($row->acquisition_date)->format('d-m-Y') : '-' }}
                                            </td>
                                            <td class="px-4 py-2">
                                                {{ number_format($row->base_price, 2) }}
                                            </td>
                                            <td class="px-4 py-2">
                                                {{ number_format($row->book_value_last_month, 2) }}
                                            </td>
                                            <td class="px-4 py-2">
                                                {{ $row->created_at->format('d-m-Y H:i') }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        {{-- PAGINATION --}}
                        <div class="mt-4">
                            {{ $asset_uploads->links() }}
                        </div>
                    @else
                        <p class="text-gray-600">
                            Belum ada data yang di upload
                        </p>
                    @endif
                </div>
            </div>
        </div>
    </div>

    {{-- Modal Progress --}}
    <div id="progressModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
            <div class="mt-3 text-center">
                <h3 class="text-lg font-medium text-gray-900" id="modalTitle">Mengupload File...</h3>

                <div class="mt-4">
                    <div class="w-full bg-gray-200 rounded-full h-4">
                        <div id="progressBar" class="bg-blue-600 h-4 rounded-full transition-all duration-300"
                            style="width: 0%">
                        </div>
                    </div>
                    <p class="mt-2 text-sm text-gray-600" id="progressText">0%</p>
                </div>

                <div class="mt-4">
                    <p class="text-sm text-gray-500" id="statusText">Memproses file...</p>
                </div>
            </div>
        </div>
    </div>

    {{-- Script Upload --}}
    <script>
        document.getElementById('uploadBtn').addEventListener('click', function() {
            const fileInput = document.getElementById('file');
            const file = fileInput.files[0];

            if (!file) {
                alert('Silakan pilih file terlebih dahulu.');
                return;
            }

            document.getElementById('progressModal').classList.remove('hidden');
            document.getElementById('progressBar').style.width = '0%';

            const formData = new FormData();
            formData.append('file', file);
            formData.append('_token', document.querySelector('input[name="_token"]').value);

            const xhr = new XMLHttpRequest();

            // PROGRESS 0-100%
            xhr.upload.addEventListener('progress', function(e) {
                if (e.lengthComputable) {
                    const percent = (e.loaded / e.total) * 100;
                    document.getElementById('progressBar').style.width = percent + '%';
                    document.getElementById('progressText').textContent = Math.round(percent) + '%';
                }
            });

            // AFTER UPLOAD FINISH
            xhr.addEventListener('load', function() {
                const response = JSON.parse(xhr.responseText);

                document.getElementById('progressBar').style.width = '100%';
                document.getElementById('progressText').textContent = '100%';

                if (response.success) {
                    document.getElementById('modalTitle').textContent = 'Import Berhasil';
                    document.getElementById('statusText').textContent = response.message;

                    setTimeout(() => {
                        window.location.href = response.redirect; // 🔥 ini kuncinya
                    }, 800);

                } else {
                    document.getElementById('modalTitle').textContent = 'Error';
                    document.getElementById('statusText').textContent = response.message;
                }
            });
            xhr.open('POST', '{{ route('asset_uploads.store') }}');
            xhr.send(formData);
        });
    </script>
@endsection
