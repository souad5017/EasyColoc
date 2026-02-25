<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-indigo-200 via-purple-200 to-pink-200 px-4">

        <div class="w-full max-w-md bg-white/80 backdrop-blur-xl p-10 rounded-3xl shadow-2xl border border-white/30">

            <!-- Title -->
            <div class="text-center mb-6">
                <h2 class="text-3xl font-extrabold text-gray-800">
                    Verify Your Email
                </h2>
                <p class="text-gray-500 mt-2 text-sm">
                    Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn't receive the email, we can send you another.
                </p>
            </div>

            <!-- Status Message -->
            @if (session('status') == 'verification-link-sent')
                <div class="mb-4 font-medium text-sm text-green-600">
                    A new verification link has been sent to your email address.
                </div>
            @endif

            <!-- Actions -->
            <div class="mt-6 flex flex-col sm:flex-row sm:justify-between items-center gap-4">
                
                <!-- Resend Verification -->
                <form method="POST" action="{{ route('verification.send') }}">
                    @csrf
                    <button type="submit"
                        class="py-3 px-6 rounded-xl font-semibold text-white bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 transition duration-300 shadow-lg w-full sm:w-auto">
                        Resend Verification Email
                    </button>
                </form>

                <!-- Logout -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                        class="text-sm text-gray-600 hover:text-gray-900 transition underline w-full sm:w-auto">
                        Log Out
                    </button>
                </form>

            </div>
        </div>
    </div>
</x-guest-layout>