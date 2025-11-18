@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold mb-4">Asset Detail</h1>

    <div class="bg-white p-6 rounded shadow">
        <div class="grid grid-cols-2 gap-4">
            <div><strong>Asset Number:</strong> {{ $asset->asset_number }}</div>
            <div><strong>Asset Name:</strong> {{ $asset->asset_name }}</div>
            <div><strong>Branch:</strong> {{ $asset->branch }}</div>
            <div><strong>Department:</strong> {{ $asset->department }}</div>
            <div><strong>Type Asset:</strong> {{ $asset->type_asset }}</div>
            <div><strong>Brand:</strong> {{ $asset->brand }}</div>
            <div><strong>Model:</strong> {{ $asset->model }}</div>
            <div><strong>Specification:</strong> {{ $asset->specification }}</div>
            <div><strong>Serial Number:</strong> {{ $asset->serial_number }}</div>
            <div><strong>RAM Capacity:</strong> {{ $asset->ram_capacity }}</div>
            <div><strong>Storage Type:</strong> {{ $asset->storage_type }}</div>
            <div><strong>Storage Volume:</strong> {{ $asset->storage_volume }}</div>
            <div><strong>OS Edition:</strong> {{ $asset->os_edition }}</div>
            <div><strong>OS Installed:</strong> {{ $asset->os_installed }}</div>
            <div><strong>Purchase Date:</strong> {{ $asset->purchase_date }}</div>
            <div><strong>Purchase Value:</strong> {{ $asset->purchase_value }}</div>
            <div><strong>Location:</strong> {{ $asset->location }}</div>
            <div><strong>Status:</strong> 
                <span class="px-2 py-1 rounded {{ $asset->status === 'active' ? 'bg-green-100 text-green-700' : 'bg-gray-200 text-gray-700' }}">
                    {{ ucfirst($asset->status) }}
                </span>
            </div>
            <div><strong>Assigned To:</strong> {{ $asset->assignedUser->name ?? '-' }}</div>
            <div><strong>Created By:</strong> {{ $asset->creator->name ?? '-' }}</div>
        </div>

        <div class="mt-6">
            <strong>Description:</strong>
            <p class="mt-2 bg-gray-50 p-3 rounded">{{ $asset->description ?? '-' }}</p>
        </div>

        <div class="mt-6 flex justify-end">
            <a href="{{ route('assets.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Back</a>
            <a href="{{ route('assets.edit', $asset->id) }}" class="ml-3 bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Edit</a>
        </div>
    </div>
</div>
@endsection
