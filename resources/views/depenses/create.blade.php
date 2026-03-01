<div>
    <x-app-layout>
        <div class="max-w-3xl mx-auto p-6 bg-white shadow rounded-lg">

            <h2 class="text-2xl font-semibold mb-4">Ajouter une dépense</h2>

            @if(session('success'))
            <div class="mb-4 px-4 py-3 rounded-lg bg-green-100 border border-green-400 text-green-700">
                {{ session('success') }}
            </div>
            @endif

            @if($errors->any())
            <div class="mb-4 px-4 py-3 rounded-lg bg-red-100 border border-red-400 text-red-700">
                <ul class="list-disc pl-5 space-y-1">
                    @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <form action="{{ route('depenses.store', $colocation->id) }}" method="POST" class="space-y-6">
                @csrf

                <!-- Label -->
                <div>
                    <label for="label" class="block text-sm font-semibold text-gray-700 mb-2">Nom de la dépense</label>
                    <input type="text" name="label" id="label" placeholder="Ex: Courses"
                        class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition shadow-sm"
                        value="{{ old('label') }}" required>
                </div>

                <!-- Montant -->
                <div>
                    <label for="amount" class="block text-sm font-semibold text-gray-700 mb-2">Montant (€)</label>
                    <input type="number" step="0.01" name="amount" id="amount" placeholder="Ex: 25.50"
                        class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition shadow-sm"
                        value="{{ old('amount') }}" required>
                </div>

                <!-- categories -->
                <div>
                    <label for="categories_id" class="block text-sm font-semibold text-gray-700 mb-2">Catégorie</label>
                    <select name="categories_id" id="categories_id"
                        class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition shadow-sm">
                        <option value="">-- Aucune catégorie --</option>
                        @foreach($categories as $categories)
                        <option value="{{ $categories->id }}" {{ old('categories_id') == $categories->id ? 'selected' : '' }}>
                            {{ $categories->name }}
                        </option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label for="user_id" class="block text-sm font-semibold text-gray-700 mb-2">
                        Payée par
                    </label>
                    <select name="user_id" id="user_id"
                        class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition shadow-sm">

                        <option value="">-- Sélectionner un membre --</option>

                        @foreach($members as $member)
                        <option value="{{ $member->id }}"
                            {{ old('user_id') == $member->id ? 'selected' : '' }}>
                            {{ $member->name }}
                        </option>
                        @endforeach

                    </select>
                </div>

                <!-- Bouton -->
                <div class="flex justify-end">
                    <button type="submit"
                        class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition">
                        Ajouter
                    </button>
                </div>
            </form>
        </div>
    </x-app-layout>