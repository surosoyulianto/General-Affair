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

        <form action="{{ route('assets_it.store') }}" method="POST" class="bg-white p-6 rounded shadow">
            @csrf

            <div class="grid grid-cols-2 gap-4">
                {{-- Asset Number --}}
                <div>
                    <label class="block font-semibold">Asset Number</label>
                    <input type="text" name="asset_number" value="{{ old('asset_number') }}" required
                        class="w-full border rounded p-2">
                </div>

                {{-- Asset Name --}}
                <div>
                    <label class="block font-semibold">Asset Name</label>
                    <input type="text" name="asset_name" value="{{ old('asset_name') }}" required
                        class="w-full border rounded p-2">
                </div>

                {{-- Branch --}}
                <div>
                    <label class="block font-semibold">Branch</label>
                    <select name="branch" class="w-full border rounded p-2">
                        <option value="">-- Select Branch --</option>
                        @foreach ($branches as $branch)
                            <option value="{{ $branch->name }}" {{ old('branch') == $branch->name ? 'selected' : '' }}>
                                {{ $branch->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Department --}}
                <div>
                    <label class="block font-semibold">Department</label>
                    <select name="department" class="w-full border rounded p-2">
                        <option value="">-- Select Department --</option>
                        @foreach ($departments as $department)
                            <option value="{{ $department->name }}"
                                {{ old('department') == $department->name ? 'selected' : '' }}>
                                {{ $department->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Specification --}}
                <div>
                    <label class="block font-semibold">Specification</label>
                    <input type="text" name="specification" value="{{ old('specification') }}"
                        class="w-full border rounded p-2">
                </div>

                {{-- Serial Number --}}
                <div>
                    <label class="block font-semibold">Serial Number</label>
                    <input type="text" name="serial_number" value="{{ old('serial_number') }}"
                        class="w-full border rounded p-2">
                </div>

                {{-- RAM --}}
                <div>
                    <label class="block font-semibold">RAM Capacity</label>
                    <input type="text" name="ram_capacity" value="{{ old('ram_capacity') }}"
                        class="w-full border rounded p-2">
                </div>

                {{-- Type Asset --}}
                <div>
                    <label class="block font-semibold">Type Asset</label>
                    <input type="text" name="type_asset" value="{{ old('type_asset') }}"
                        class="w-full border rounded p-2">
                </div>

                {{-- Storage Type --}}
                <div>
                    <label class="block font-semibold">Storage Type</label>
                    <input type="text" name="storage_type" value="{{ old('storage_type') }}"
                        class="w-full border rounded p-2">
                </div>

                {{-- Storage Volume --}}
                <div>
                    <label class="block font-semibold">Storage Volume</label>
                    <input type="text" name="storage_volume" value="{{ old('storage_volume') }}"
                        class="w-full border rounded p-2">
                </div>

                {{-- OS Edition --}}
                <div>
                    <label class="block font-semibold">OS Edition</label>
                    <input type="text" name="os_edition" value="{{ old('os_edition') }}"
                        class="w-full border rounded p-2">
                </div>

                {{-- OS Installed --}}
                <div>
                    <label class="block font-semibold">OS Installed Date</label>
                    <input type="date" name="os_installed" value="{{ old('os_installed') }}"
                        class="w-full border rounded p-2">
                </div>

                {{-- Brand --}}
                <div>
                    <label class="block font-semibold">Brand</label>
                    <input type="text" name="brand" value="{{ old('brand') }}" class="w-full border rounded p-2">
                </div>

                {{-- Model --}}
                <div>
                    <label class="block font-semibold">Model</label>
                    <input type="text" name="model" value="{{ old('model') }}" class="w-full border rounded p-2">
                </div>

                {{-- Purchase Date --}}
                <div>
                    <label class="block font-semibold">Purchase Date</label>
                    <input type="date" name="purchase_date" value="{{ old('purchase_date') }}"
                        class="w-full border rounded p-2">
                </div>

                {{-- Purchase Value --}}
                <div>
                    <label class="block font-semibold">Purchase Value</label>
                    <input type="text" name="purchase_value" value="{{ old('purchase_value') }}"
                        class="w-full border rounded p-2">
                </div>

                {{-- Location --}}
                <div>
                    <label class="block font-semibold">Location</label>
                    <input type="text" name="location" value="{{ old('location') }}" class="w-full border rounded p-2">
                </div>

                {{-- Status --}}
                <div>
                    <label class="block font-semibold">Status</label>
                    <select name="status" class="w-full border rounded p-2">
                        <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
                        <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>

                {{-- Select Owner --}}
                <div class="col-span-2">
                    <label class="block font-semibold">Select Owner</label>
                    <select name="owner" class="w-full border rounded p-2">
                        <option value="">-- Select Owner --</option>
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}" {{ old('owner') == $user->id ? 'selected' : '' }}>
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
                <a href="{{ route('assets_it.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
                    Cancel
                </a>
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 ml-3">
                    Save
                </button>
            </div>
        </form>
    </div>
@endsection
