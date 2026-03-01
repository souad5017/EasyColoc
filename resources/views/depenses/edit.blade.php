<div>
    <x-app-layout>
        <div class="max-w-3xl mx-auto p-6 bg-white shadow rounded-lg">

            <h2 class="text-2xl font-semibold mb-4">Modifier la dépense</h2>

            @if($errors->any())
                <div class="mb-4 px-4 py-3 rounded-lg bg-red-100 border border-red-400 text-red-700">
                    <ul class="list-disc pl-5 space-y-1">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('depenses.update', [$colocation->id, $depense->id]) }}" 
                  method="POST" 
                  class="space-y-6">
                @csrf

                <!-- Label -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        Nom de la dépense
                    </label>
                    <input type="text"
                           name="label"
                           class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:ring-2 focus:ring-blue-500"
                           value="{{ old('label', $depense->label) }}"
                           required>
                </div>

                <!-- Montant -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        Montant (€)
                    </label>
                    <input type="number"
                           step="0.01"
                           name="amount"
                           class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:ring-2 focus:ring-blue-500"
                           value="{{ old('amount', $depense->amount) }}"
                           required>
                </div>

                <!-- Catégorie -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        Catégorie
                    </label>
                    <select name="categories_id"
                            class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:ring-2 focus:ring-blue-500">

                        @foreach($categories as $category)
                            <option value="{{ $category->id }}"
                                {{ old('categories_id', $depense->categories_id) == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach

                    </select>
                </div>

                <!-- Payée par -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        Payée par
                    </label>
                    <select name="user_id"
                            class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:ring-2 focus:ring-blue-500">

                        @foreach($members as $member)
                            <option value="{{ $member->id }}"
                                {{ old('user_id', $depense->user_id) == $member->id ? 'selected' : '' }}>
                                {{ $member->name }}
                            </option>
                        @endforeach

                    </select>
                </div>

                <!-- Button -->
                <div class="flex justify-end">
                    <button type="submit"
                        class="bg-yellow-500 text-white px-6 py-3 rounded-lg hover:bg-yellow-600 transition">
                        Mettre à jour
                    </button>
                </div>

            </form>
        </div>
    </x-app-layout>
</div>