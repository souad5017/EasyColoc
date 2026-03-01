<x-app-layout>
    <div class="min-h-screen bg-gray-50 flex items-center justify-center px-4 py-12">
        <div class="w-full max-w-lg bg-white rounded-2xl shadow p-8">
            <h2 class="text-2xl font-bold mb-6 text-gray-800">Ajouter une catégorie</h2>

            <!-- Success Message -->
            @if(session('success'))
                <div class="mb-4 px-4 py-3 rounded-lg bg-green-600 text-white shadow">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Error Messages -->
            @if($errors->any())
                <div class="mb-4 px-4 py-3 rounded-lg bg-red-100 border border-red-400 text-red-700">
                    <ul class="list-disc pl-5 space-y-1">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Form -->
            <form action="{{ route('categories.store', $colocation->id) }}" method="POST" class="space-y-6">
                @csrf

                <div>
                    <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">Nom de la catégorie</label>
                    <input type="text"
                           name="name"
                           id="name"
                           placeholder="Ex: Nourriture"
                           class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition shadow-sm"
                           required>
                </div>

                <div class="flex justify-end">
                    <button type="submit"
                            class="px-6 py-3 rounded-xl bg-blue-600 text-white font-bold hover:bg-blue-700 shadow transition">
                        Ajouter
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>