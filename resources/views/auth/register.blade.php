<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-indigo-200 via-purple-200 to-pink-200 px-4">

        <div class="w-full max-w-md bg-white/80 backdrop-blur-xl p-10 rounded-3xl shadow-2xl border border-white/30">

            <!-- Title -->
            <div class="text-center mb-8 flex flex-col items-center justify-center">
                <x-application-logo class="w-24 h-24 fill-current text-indigo-600" />

                <h2 class="text-4xl font-extrabold text-gray-800">
                    Create Account
                </h2>
                <p class="text-gray-500 mt-2 text-sm">
                    Join EasyColoc and manage your colocation smarter
                </p>
            </div>

            <form method="POST" action="{{ route('register') }}" class="space-y-6">
                @csrf

                <!-- Name -->
                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-1">Full Name</label>
                    <input type="text" name="name" value="{{ old('name') }}"
                        class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-white/70 focus:ring-2 focus:ring-purple-400 focus:border-purple-400 transition duration-300 outline-none"
                        placeholder="Enter your full name" required autofocus>
                    @error('name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Email -->
                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-1">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}"
                        class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-white/70 focus:ring-2 focus:ring-purple-400 focus:border-purple-400 transition duration-300 outline-none"
                        placeholder="example@email.com" required>
                    @error('email')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password -->
                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-1">Password</label>
                    <input type="password" name="password"
                        class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-white/70 focus:ring-2 focus:ring-purple-400 focus:border-purple-400 transition duration-300 outline-none"
                        placeholder="••••••••" required>
                    @error('password')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Confirm Password -->
                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-1">Confirm Password</label>
                    <input type="password" name="password_confirmation"
                        class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-white/70 focus:ring-2 focus:ring-purple-400 focus:border-purple-400 transition duration-300 outline-none"
                        placeholder="••••••••" required>
                </div>

                <!-- Register Button -->
                <button type="submit"
                    class="w-full py-3 rounded-xl font-semibold text-white bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 transition duration-300 shadow-lg">
                    Create Account
                </button>

                <!-- Login Link -->
                <p class="text-center text-sm text-gray-600 mt-6">
                    Already have an account?
                    <a href="{{ route('login') }}" class="font-semibold text-purple-600 hover:text-purple-800 transition">
                        Login
                    </a>
                </p>

            </form>
        </div>
    </div>
</x-guest-layout>