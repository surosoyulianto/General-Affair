@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">

    <h1 class="text-2xl font-bold mb-4">Edit Transfer</h1>

    <div class="bg-white shadow rounded p-6">

        <form action="{{ route('asset-transfers.update', $transfer->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-2 gap-4">

                <div>
                    <label class="block mb-1 font-semibold">Asset</label>
                    <select name="asset_id" class="w-full border p-2 rounded" required>
                        @foreach($assets as $a)
                            <option value="{{ $a->id }}" 
                                {{ $transfer->asset_id == $a->id ? 'selected' : '' }}>
                                {{ $a->asset_name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block mb-1 font-semibold">Transfer To User</label>
                    <select name="to_user_id" class="w-full border p-2 rounded" required>
                        @foreach($users as $u)
                            <option value="{{ $u->id }}"
                                {{ $transfer->to_user_id == $u->id ? 'selected' : '' }}>
                                {{ $u->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block mb-1 font-semibold">Transfer Date</label>
                    <input type="date" name="transfer_date" 
                           class="w-full border p-2 rounded"
                           value="{{ $transfer->transfer_date }}" required>
                </div>

                <div class="col-span-2">
                    <label class="block mb-1 font-semibold">Reason</label>
                    <textarea name="reason" class="w-full border p-2 rounded" rows="3">
                        {{ $transfer->reason }}
                    </textarea>
                </div>
            </div>

            <div class="mt-4">
                <button class="bg-yellow-600 text-white px-4 py-2 rounded hover:bg-yellow-700">
                    Update Transfer
                </button>
                <a href="{{ route('asset-transfers.index') }}" class="ml-2 text-gray-600">
                    Cancel
                </a>
            </div>

        </form>

    </div>
</div>
@endsection
