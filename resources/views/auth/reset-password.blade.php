<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-indigo-200 via-purple-200 to-pink-200 px-4">

        <div class="w-full max-w-md bg-white/80 backdrop-blur-xl p-10 rounded-3xl shadow-2xl border border-white/30">

            <!-- Title -->
            <div class="text-center mb-6">
                <h2 class="text-3xl font-extrabold text-gray-800">
                    Reset Password
                </h2>
                <p class="text-gray-500 mt-2 text-sm">
                    Enter your email and new password to reset your account.
                </p>
            </div>

            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('password.store') }}" class="space-y-6">
                @csrf

                <!-- Password Reset Token -->
                <input type="hidden" name="token" value="{{ $request->route('token') }}">

                <!-- Email Address -->
                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-1" for="email">Email</label>
                    <input id="email" type="email" name="email" :value="old('email', $request->email)" required autofocus
                        class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-white/70 focus:ring-2 focus:ring-purple-400 focus:border-purple-400 transition duration-300 outline-none"
                        placeholder="Enter your email">
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-1" for="password">New Password</label>
                    <input id="password" type="password" name="password" required
                        class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-white/70 focus:ring-2 focus:ring-purple-400 focus:border-purple-400 transition duration-300 outline-none"
                        placeholder="••••••••">
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Confirm Password -->
                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-1" for="password_confirmation">Confirm Password</label>
                    <input id="password_confirmation" type="password" name="password_confirmation" required
                        class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-white/70 focus:ring-2 focus:ring-purple-400 focus:border-purple-400 transition duration-300 outline-none"
                        placeholder="••••••••">
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>

                <!-- Reset Button -->
                <div class="flex justify-end mt-4">
                    <button type="submit"
                        class="py-3 px-8 rounded-xl font-semibold text-white bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 transition duration-300 shadow-lg">
                        Reset Password
                    </button>
                </div>
            </form>

            <!-- Back to Login -->
            <p class="text-center text-sm text-gray-600 mt-6">
                Remembered your password?
                <a href="{{ route('login') }}" class="font-semibold text-purple-600 hover:text-purple-800 transition">
                    Log in
                </a>
            </p>

        </div>
    </div>
</x-guest-layout>