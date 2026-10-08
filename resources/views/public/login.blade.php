<x-layout>
    <div class="min-h-screen flex items-center justify-center bg-gray-100 px-4">
        <div class="w-full max-w-md">
            <div class="bg-white rounded-2xl shadow-lg p-8">

                {{-- Header --}}
                <div class="text-center mb-8">
                    <h1 class="text-3xl font-bold text-gray-800">
                        Selamat Datang
                    </h1>
                    <p class="text-gray-500 mt-2">
                        Silakan login ke akun Anda
                    </p>
                </div>

                <form action="{{ route('post.login') }}" method="POST" class="space-y-5">
                    @csrf

                    {{-- Email --}}
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                            Email
                        </label>

                        <input
                            type="email"
                            name="email"
                            id="email"
                            value="{{ old('email') }}"
                            placeholder="Masukkan email Anda"
                            class="w-full px-4 py-3 rounded-xl border border-gray-300
                                   focus:border-pink-500 focus:ring-2 focus:ring-pink-200
                                   outline-none transition
                                   @error('email') border-red-500 @enderror"
                        >

                        @error('email')
                            <p class="text-red-500 text-sm mt-1">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    {{-- Password --}}
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
                            Password
                        </label>

                        <div class="relative">
                            <input
                                type="password"
                                name="password"
                                id="password"
                                placeholder="Masukkan password Anda"
                                class="w-full px-4 py-3 pr-12 rounded-xl border border-gray-300
                                       focus:border-pink-500 focus:ring-2 focus:ring-pink-200
                                       outline-none transition
                                       @error('password') border-red-500 @enderror"
                            >

                            {{-- Toggle Password --}}
                            <button
                                type="button"
                                onclick="togglePassword()"
                                class="absolute inset-y-0 right-0 flex items-center px-4
                                       text-gray-500 hover:text-pink-600 transition"
                            >
                                {{-- Eye Open --}}
                                <svg
                                    id="eye-open"
                                    xmlns="http://www.w3.org/2000/svg"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke-width="1.8"
                                    stroke="currentColor"
                                    class="w-5 h-5"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M2.25 12s3.75-6.75 9.75-6.75S21.75 12 21.75 12
                                           18 18.75 12 18.75 2.25 12 2.25 12Z"
                                    />
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M15.75 12a3.75 3.75 0 1 1-7.5 0
                                           3.75 3.75 0 0 1 7.5 0Z"
                                    />
                                </svg>

                                {{-- Eye Closed --}}
                                <svg
                                    id="eye-closed"
                                    xmlns="http://www.w3.org/2000/svg"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke-width="1.8"
                                    stroke="currentColor"
                                    class="w-5 h-5 hidden"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M3.98 8.223A10.477 10.477 0 0 0 2.25 12
                                           S6 18.75 12 18.75c1.69 0 3.22-.423 4.54-1.114"
                                    />
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M6.228 6.228A10.451 10.451 0 0 1 12 5.25
                                           C18 5.25 21.75 12 21.75 12
                                           a18.56 18.56 0 0 1-3.092 3.997"
                                    />
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M3 3l18 18"
                                    />
                                </svg>
                            </button>
                        </div>

                        @error('password')
                            <p class="text-red-500 text-sm mt-1">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    {{-- Error Login --}}
                    @if (session('error'))
                        <div class="bg-red-50 border border-red-200 text-red-600
                                    px-4 py-3 rounded-xl text-sm">
                            {{ session('error') }}
                        </div>
                    @endif

                    {{-- Login Button --}}
                    <button
                        type="submit"
                        class="w-full bg-pink-600 hover:bg-pink-700
                               text-white font-semibold py-3 rounded-xl
                               transition duration-200
                               focus:outline-none focus:ring-2 focus:ring-pink-300"
                    >
                        Login
                    </button>

                </form>
            </div>
        </div>
    </div>

    <script>
        function togglePassword() {
            const password = document.getElementById('password');
            const eyeOpen = document.getElementById('eye-open');
            const eyeClosed = document.getElementById('eye-closed');

            if (password.type === 'password') {
                password.type = 'text';

                eyeOpen.classList.add('hidden');
                eyeClosed.classList.remove('hidden');
            } else {
                password.type = 'password';

                eyeOpen.classList.remove('hidden');
                eyeClosed.classList.add('hidden');
            }
        }
    </script>
</x-layout>
