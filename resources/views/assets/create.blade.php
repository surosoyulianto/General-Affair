@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-6">
        <h1 class="text-2xl font-bold mb-4">Create New Asset</h1>

        @if ($errors->any())
            <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('assets.store') }}" method="POST" class="bg-white p-6 rounded shadow">
            @csrf

            <div class="grid grid-cols-2 gap-4">
                {{-- Asset No --}}
                <div>
                    <label class="block font-semibold">Asset No</label>
                    <input type="text" name="asset_no" value="{{ old('asset_no') }}"
                        class="w-full border rounded p-2">
                </div>

                {{-- Department --}}
                <div>
                    <label class="block font-semibold">Department</label>
                    <input type="text" name="dept" value="{{ old('dept') }}"
                        class="w-full border rounded p-2">
                </div>

                {{-- Acquisition Date --}}
                <div>
                    <label class="block font-semibold">Acquisition Date</label>
                    <input type="date" name="acquisition_date" value="{{ old('acquisition_date') }}"
                        class="w-full border rounded p-2">
                </div>

                {{-- End Date --}}
                <div>
                    <label class="block font-semibold">End Date</label>
                    <input type="date" name="end_date" value="{{ old('end_date') }}"
                        class="w-full border rounded p-2">
                </div>

                {{-- Voucher Aqc --}}
                <div>
                    <label class="block font-semibold">Voucher Aqc</label>
                    <input type="text" name="voucher_aqc" value="{{ old('voucher_aqc') }}"
                        class="w-full border rounded p-2">
                </div>

                {{-- Base Price --}}
                <div>
                    <label class="block font-semibold">Base Price</label>
                    <input type="number" step="0.01" name="base_price" value="{{ old('base_price') }}"
                        class="w-full border rounded p-2">
                </div>

                {{-- Accumulation Last Year --}}
                <div>
                    <label class="block font-semibold">Accumulation Last Year</label>
                    <input type="number" step="0.01" name="accumulation_last_year" value="{{ old('accumulation_last_year') }}"
                        class="w-full border rounded p-2">
                </div>

                {{-- Ending Book Value Last Year --}}
                <div>
                    <label class="block font-semibold">Ending Book Value Last Year</label>
                    <input type="number" step="0.01" name="ending_book_value_last_year" value="{{ old('ending_book_value_last_year') }}"
                        class="w-full border rounded p-2">
                </div>

                {{-- Dep Rate --}}
                <div>
                    <label class="block font-semibold">Dep Rate</label>
                    <input type="number" step="0.01" name="dep_rate" value="{{ old('dep_rate') }}"
                        class="w-full border rounded p-2">
                </div>

                {{-- Depreciation Yearly --}}
                <div>
                    <label class="block font-semibold">Depreciation Yearly</label>
                    <input type="number" step="0.01" name="depreciation_yearly" value="{{ old('depreciation_yearly') }}"
                        class="w-full border rounded p-2">
                </div>

                {{-- Book Value Last Month --}}
                <div>
                    <label class="block font-semibold">Book Value Last Month</label>
                    <input type="number" step="0.01" name="book_value_last_month" value="{{ old('book_value_last_month') }}"
                        class="w-full border rounded p-2">
                </div>

                {{-- Depreciation Accum Depr --}}
                <div>
                    <label class="block font-semibold">Depreciation Accum Depr</label>
                    <input type="number" step="0.01" name="depreciation_accum_depr" value="{{ old('depreciation_accum_depr') }}"
                        class="w-full border rounded p-2">
                </div>

                {{-- Depreciation Book Value --}}
                <div>
                    <label class="block font-semibold">Depreciation Book Value</label>
                    <input type="number" step="0.01" name="depreciation_book_value" value="{{ old('depreciation_book_value') }}"
                        class="w-full border rounded p-2">
                </div>

                {{-- Select User --}}
                <div class="col-span-2">
                    <label class="block font-semibold">Select User</label>
                    <select name="user_id" class="w-full border rounded p-2">
                        <option value="">-- Select User --</option>
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                                {{ $user->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Description --}}
                <div class="col-span-2">
                    <label class="block font-semibold">Description</label>
                    <textarea name="description" rows="3" class="w-full border rounded p-2">{{ old('description') }}</textarea>
                </div>
            </div>

            <div class="mt-6 flex justify-end">
                <a href="{{ route('assets.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
                    Cancel
                </a>
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 ml-3">
                    Save
                </button>
            </div>
        </form>
    </div>
@endsection
