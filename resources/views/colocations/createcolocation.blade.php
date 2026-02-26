<x-app-layout>
    <x-slot name="header">
        <h2 class="font-extrabold text-3xl bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent">
            Create Your Colocation
        </h2>
    </x-slot>

    <div class="min-h-screen flex items-center justify-center px-4">

        <div class="w-full max-w-3xl">

            <!-- Card -->
            <div class="relative bg-white/70 backdrop-blur-2xl shadow-2xl rounded-3xl p-10 border border-white/40">

                <!-- Decorative Gradient -->
                <div class="absolute -top-10 -right-10 w-40 h-40 bg-indigo-400 rounded-full blur-3xl opacity-20"></div>
                <div class="absolute -bottom-10 -left-10 w-40 h-40 bg-purple-400 rounded-full blur-3xl opacity-20"></div>

                <form method="POST" action="{{ route('colocations.store') }}" class="space-y-8 relative z-10">
                    @csrf

                    <!-- Name -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            Colocation Name
                        </label>
                        <input type="text"
                               name="name"
                               placeholder="Ex: Casa Downtown"
                               class="w-full px-5 py-4 rounded-2xl border border-gray-200 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition shadow-sm"
                               required>
                    </div>

                    <!-- Description -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            Description
                        </label>
                        <textarea name="description"
                                  rows="4"
                                  placeholder="Short description about this colocation..."
                                  class="w-full px-5 py-4 rounded-2xl border border-gray-200 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition shadow-sm"></textarea>
                    </div>

                    <!-- Buttons -->
                    <div class="flex justify-between items-center pt-6">

                        <a href="{{ route('dashboard') }}"
                           class="text-gray-600 font-semibold hover:text-gray-900 transition">
                            ← Back to Dashboard
                        </a>

                        <button type="submit"
                                class="px-8 py-4 rounded-2xl bg-gradient-to-r from-indigo-600 to-purple-600 text-white font-bold shadow-xl hover:scale-105 hover:shadow-2xl transition duration-300">
                            Create Colocation 
                        </button>

                    </div>
                </form>

            </div>

        </div>
    </div>
</x-app-layout>