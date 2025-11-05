@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-6 py-6">

    {{-- Header --}}
    <div class="flex items-center justify-between mb-6 pb-3 border-b border-gray-200">
        <h1 class="text-2xl font-semibold text-gray-800">User Management</h1>
        <a href="{{ route('administrator.users.create') }}"
           class="inline-flex items-center px-5 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg shadow hover:bg-blue-700 hover:shadow-lg transition">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24"
                 stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>
            Tambah User
        </a>
    </div>

    {{-- Table --}}
    <div class="bg-white shadow-md rounded-xl overflow-hidden border border-gray-200">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">#</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Nama</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Email</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Status</th>
                    <th class="px-4 py-3 text-center text-sm font-semibold text-gray-700">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-100">
                @forelse ($users as $user)
                    <tr class="hover:bg-gray-50 transition-colors duration-200 {{ $loop->even ? 'bg-gray-50' : '' }}">
                        <td class="px-4 py-3 text-sm text-gray-600">{{ $loop->iteration + $users->firstItem() - 1 }}</td>
                        <td class="px-4 py-3 text-sm text-gray-800">{{ $user->name }}</td>
                        <td class="px-4 py-3 text-sm text-gray-800">{{ $user->email }}</td>
                        <td class="px-4 py-3">
                            @if ($user->status === 'active')
                                <span class="px-3 py-1 text-xs font-semibold rounded-full bg-gradient-to-r from-green-200 to-green-400 text-green-800">Active</span>
                            @else
                                <span class="px-3 py-1 text-xs font-semibold rounded-full bg-gradient-to-r from-red-200 to-red-400 text-red-800">Inactive</span>
                            @endif
                        </td>
                        <td class="px-4 py-3 text-center text-sm">
                            <div class="flex justify-center space-x-3">
                                <a href="{{ route('administrator.users.edit', $user->id) }}" 
                                   class="text-blue-600 hover:text-blue-800 font-medium flex items-center space-x-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                                         stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M11 5h6M6 12h6m-6 7h6" />
                                    </svg>
                                    <span>Edit</span>
                                </a>
                                <form action="{{ route('administrator.users.destroy', $user->id) }}" method="POST"
                                      onsubmit="return confirm('Yakin ingin hapus user ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-800 font-medium flex items-center space-x-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                                             stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                  d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                        <span>Hapus</span>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-4 py-3 text-center text-gray-500">Belum ada user</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    <div class="mt-4">
        {{ $users->onEachSide(1)->links('vendor.pagination.tailwind') }}
    </div>

</div>
@endsection
