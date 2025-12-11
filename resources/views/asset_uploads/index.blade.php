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
                        <input type="file" name="file" id="file"
                            accept=".xlsx,.xls"
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

                <h3 class="text-lg font-semibold text-gray-800 mb-4">
                    Data Asset Upload
                </h3>

                @if($asset_uploads->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-600 uppercase">No</th>
                                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-600 uppercase">Asset No</th>
                                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-600 uppercase">Description</th>
                                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-600 uppercase">Dept</th>
                                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-600 uppercase">Acquisition Date</th>
                                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-600 uppercase">Base Price</th>
                                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-600 uppercase">Book Value Last Month</th>
                                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-600 uppercase">Uploaded At</th>
                                </tr>
                            </thead>

                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($asset_uploads as $row)
                                    <tr>
                                        <td class="px-4 py-2">{{ $loop->iteration }}</td>
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
                @else
                    <p class="text-gray-600">Belum ada data di tabel asset_upload.</p>
                @endif

            </div>
        </div>
    </div>
</div>

{{-- Modal Progress --}}
<div id="progressModal"
    class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
        <div class="mt-3 text-center">
            <h3 class="text-lg font-medium text-gray-900" id="modalTitle">Mengupload File...</h3>

            <div class="mt-4">
                <div class="w-full bg-gray-200 rounded-full h-4">
                    <div id="progressBar"
                        class="bg-blue-600 h-4 rounded-full transition-all duration-300"
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

        xhr.upload.addEventListener('progress', function(e) {
            if (e.lengthComputable) {
                const percent = Math.min((e.loaded / e.total) * 80, 80);
                document.getElementById('progressBar').style.width = percent + '%';
                document.getElementById('progressText').textContent = Math.round(percent) + '%';
            }
        });

        xhr.addEventListener('load', function() {
            const response = JSON.parse(xhr.responseText);

            if (response.success) {
                animateProgress(80, 100, function() {
                    document.getElementById('modalTitle').textContent = 'Import Berhasil';
                    document.getElementById('statusText').textContent = response.message;

                    setTimeout(() => { window.location.reload(); }, 1000);
                });
            } else {
                document.getElementById('modalTitle').textContent = 'Error';
                document.getElementById('statusText').textContent = response.message;
            }
        });

        xhr.open('POST', '{{ route("asset_uploads.store") }}');
        xhr.send(formData);
    });

    function animateProgress(from, to, callback) {
        const bar = document.getElementById('progressBar');
        const text = document.getElementById('progressText');

        const duration = 1500;
        const start = Date.now();
        const diff = to - from;

        function update() {
            const elapsed = Date.now() - start;
            const progress = Math.min(from + diff * (elapsed / duration), to);

            bar.style.width = progress + '%';
            text.textContent = Math.round(progress) + '%';

            if (progress < to) requestAnimationFrame(update);
            else if (callback) callback();
        }

        requestAnimationFrame(update);
    }
</script>

@endsection
