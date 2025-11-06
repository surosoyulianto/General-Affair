@extends('layouts.app')

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- ===================== --}}
            {{-- Update Profile Section --}}
            {{-- ===================== --}}
            <div class="p-6 bg-white shadow sm:rounded-lg">
                <h3 class="text-lg font-semibold mb-4 text-gray-800">Profile Information</h3>

                <div class="flex items-start gap-6">
                    {{-- Foto Profil --}}
                    <div class="flex flex-col items-center">
                        <div class="w-32 h-32 rounded-full overflow-hidden border border-gray-300 shadow">
                            <img id="photoPreview"
                                src="{{ $user->photo ? asset('storage/' . $user->photo) : 'https://ui-avatars.com/api/?name=' . urlencode($user->name) . '&background=random' }}"
                                alt="Profile Photo" class="object-cover w-full h-full">
                        </div>

                        <label
                            class="mt-3 inline-block bg-gray-100 hover:bg-gray-200 text-gray-700 text-sm px-3 py-1 rounded cursor-pointer">
                            <input type="file" name="photo" id="photoInput" class="hidden" accept="image/*">
                            Change Photo
                        </label>
                    </div>

                    {{-- Form Profil --}}
                    <div class="flex-1">
                        <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')

                            <div class="mb-4">
                                <label class="block text-gray-700">Name</label>
                                <input type="text" name="name" value="{{ old('name', $user->name) }}"
                                    class="w-full border rounded p-2">
                                @error('name')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label class="block text-gray-700">Email</label>
                                <input type="email" name="email" value="{{ old('email', $user->email) }}"
                                    class="w-full border rounded p-2">
                                @error('email')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <button type="submit"
                                class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
                                Save Changes
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="p-6 bg-white shadow sm:rounded-lg">
                {{-- ===================== --}}
                {{-- Change Password Section --}}
                {{-- ===================== --}}
                <div class="p-1 bg-white shadow sm:rounded-lg">
                    <h3 class="text-lg font-semibold mb-3 text-gray-800">Change Password</h3>

                    {{-- Form Password (default terlihat agar tetap muncul jika JS mati) --}}
                    <div id="passwordFormContainer" class="mt-2">
                        <form method="POST" action="{{ route('profile.password.update') }}">
                            @csrf
                            @method('PATCH')

                            <div class="mb-3">
                                <label class="block text-gray-700">Current Password</label>
                                <input type="password" name="current_password" class="w-full border rounded p-2">
                            </div>

                            <div class="mb-3">
                                <label class="block text-gray-700">New Password</label>
                                <input type="password" name="password" class="w-full border rounded p-2">
                            </div>

                            <div class="mb-4">
                                <label class="block text-gray-700">Confirm Password</label>
                                <input type="password" name="password_confirmation" class="w-full border rounded p-2">
                            </div>

                            {{-- Tombol aksi di kanan --}}
                            <div class="flex justify-end gap-3 mt-2">
                                <button type="button" id="cancelPasswordForm"
                                    class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700 transition">
                                    Cancel
                                </button>

                                <button type="submit"
                                    class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
                                    Save Password
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- ===================== --}}
    {{-- Scripts --}}
    {{-- ===================== --}}
    <script>
        // Preview foto profil
        const photoInput = document.getElementById('photoInput');
        const photoPreview = document.getElementById('photoPreview');
        photoInput?.addEventListener('change', (e) => {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = () => photoPreview.src = reader.result;
                reader.readAsDataURL(file);
            }
        });
    </script>
@endsection
