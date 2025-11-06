@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto bg-white shadow rounded-lg p-6">
    <h2 class="text-2xl font-bold mb-6 text-gray-700">Create New Asset</h2>

    <form action="{{ route('assets.store') }}" method="POST">
        @csrf

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            {{-- Asset Number --}}
            <div>
                <label class="block text-gray-700 font-medium mb-2">Asset Number</label>
                <input type="text" name="asset_number" value="{{ old('asset_number') }}"
                    class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500" required>
                @error('asset_number') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            {{-- Name --}}
            <div>
                <label class="block text-gray-700 font-medium mb-2">Owner</label>
                <input type="text" name="name" value="{{ old('name') }}"
                    class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
            </div>

            {{-- Branch --}}
            <div>
                <label class="block text-gray-700 font-medium mb-2">Branch</label>
                <select name="branch" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500" required>
                    <option value="">-- Select Branch --</option>
                    @foreach ($branches as $branch)
                        <option value="{{ $branch->id }}" {{ old('branch') == $branch->id ? 'selected' : '' }}>
                            {{ $branch->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Department --}}
            <div>
                <label class="block text-gray-700 font-medium mb-2">Department</label>
                <select name="department" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500" required>
                    <option value="">-- Select Department --</option>
                    @foreach ($departments as $department)
                        <option value="{{ $department->id }}" {{ old('department') == $department->id ? 'selected' : '' }}>
                            {{ $department->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Type Asset --}}
            <div>
                <label class="block text-gray-700 font-medium mb-2">Type Asset</label>
                <input type="text" name="type_asset" value="{{ old('type_asset') }}"
                    class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
            </div>

            {{-- System Info --}}
            <div>
                <label class="block text-gray-700 font-medium mb-2">System Info</label>
                <input type="text" name="system_info" value="{{ old('system_info') }}"
                    class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
            </div>

            {{-- Brand --}}
            <div>
                <label class="block text-gray-700 font-medium mb-2">Brand</label>
                <input type="text" name="brand" value="{{ old('brand') }}"
                    class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
            </div>

            {{-- Model --}}
            <div>
                <label class="block text-gray-700 font-medium mb-2">Model</label>
                <input type="text" name="model" value="{{ old('model') }}"
                    class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
            </div>

            {{-- Specification --}}
            <div class="col-span-2">
                <label class="block text-gray-700 font-medium mb-2">Specification</label>
                <input type="text" name="specification" value="{{ old('specification') }}"
                    class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
            </div>

            {{-- Serial Number --}}
            <div>
                <label class="block text-gray-700 font-medium mb-2">Serial Number</label>
                <input type="text" name="serial_number" value="{{ old('serial_number') }}"
                    class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
            </div>

            {{-- Purchase Date --}}
            <div>
                <label class="block text-gray-700 font-medium mb-2">Purchase Date</label>
                <input type="date" name="purchase_date" value="{{ old('purchase_date') }}"
                    class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
            </div>

            {{-- Purchase Value --}}
            <div>
                <label class="block text-gray-700 font-medium mb-2">Purchase Value</label>
                <input type="number" step="0.01" name="purchase_value" value="{{ old('purchase_value') }}"
                    class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
            </div>

            {{-- Location --}}
            <div>
                <label class="block text-gray-700 font-medium mb-2">Location</label>
                <input type="text" name="location" value="{{ old('location') }}"
                    class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
            </div>

            {{-- Status --}}
            <div>
                <label class="block text-gray-700 font-medium mb-2">Status</label>
                <select name="status" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                    <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
                    <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                    <option value="disposed" {{ old('status') == 'disposed' ? 'selected' : '' }}>Disposed</option>
                </select>
            </div>

            {{-- Description --}}
            <div class="col-span-2">
                <label class="block text-gray-700 font-medium mb-2">Description</label>
                <textarea name="description" rows="3"
                    class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500">{{ old('description') }}</textarea>
            </div>
        </div>

        <div class="flex justify-end mt-6">
            <a href="{{ route('assets.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600 mr-2">Cancel</a>
            <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700">Save</button>
        </div>
    </form>
</div>
@endsection
