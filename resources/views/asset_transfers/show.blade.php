@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">

    <h1 class="text-2xl font-bold mb-4">Transfer Detail</h1>

    <div class="bg-white shadow rounded p-6">

        <p><strong>Asset:</strong> {{ $transfer->asset->asset_name }}</p>
        <p><strong>From User:</strong> {{ $transfer->fromUser->name ?? '-' }}</p>
        <p><strong>To User:</strong> {{ $transfer->toUser->name ?? '-' }}</p>
        <p><strong>Date:</strong> {{ $transfer->transfer_date }}</p>
        <p><strong>Reason:</strong> {{ $transfer->reason ?? '-' }}</p>

        <div class="mt-4">
            <a href="{{ route('asset-transfers.index') }}" class="text-blue-600">Back</a>
        </div>

    </div>

</div>
@endsection
