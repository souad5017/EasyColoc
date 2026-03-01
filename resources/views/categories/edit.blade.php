<div>
   <x-app-layout>
<div class="max-w-xl mx-auto p-6 bg-white rounded-2xl shadow-md">
    <h2 class="text-2xl font-bold mb-4">Modifier la catégorie</h2>

    @if(session('success'))
        <div class="mb-4 p-3 bg-green-100 text-green-700 rounded">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('categories.update', $category->id) }}" method="POST" class="space-y-4">
        @csrf

        <div>
            <label class="block text-sm font-medium mb-1">Nom de la catégorie</label>
            <input type="text" name="name" value="{{ old('name', $category->name) }}"
                   class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-indigo-500">
            @error('name')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit"
                class="px-6 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700">
            Mettre à jour
        </button>
    </form>
</div>
</x-app-layout>
