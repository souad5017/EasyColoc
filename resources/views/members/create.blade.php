<x-app-layout>
<div class="container mx-auto p-6">
    <h1 class="text-2xl font-bold mb-4">Envoyer une invitation à un nouveau membre</h1>

    @if(session('success'))
        <div class="bg-green-100 text-green-800 p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="bg-red-100 text-red-800 p-3 rounded mb-4">
            {{ session('error') }}
        </div>
    @endif

    <!-- Formulaire d'envoi -->
    <form action="{{ route('members.store', $colocation->id) }}" method="POST" class="space-y-4">
        @csrf

        <div>
            <label for="email" class="block font-semibold mb-1">Email du membre</label>
            <input type="email" name="email" id="email" value="{{ old('email') }}"
                   class="w-full p-2 border rounded" required>
            @error('email')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            Envoyer l'invitation
        </button>
    </form>

    <!-- Affichage du lien d'invitation après création -->
    @if(session('invite_url'))
        <div class="mt-6 p-4 bg-white border rounded shadow">
            <h2 class="font-bold mb-2">🔗 Lien d'invitation :</h2>
            <div class="flex gap-2">
                <input type="text" readonly value="{{ session('invite_url') }}"
                       class="flex-1 p-2 border rounded bg-gray-100 cursor-pointer">
                <button type="button" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700"
                        onclick="navigator.clipboard.writeText('{{ session('invite_url') }}').then(() => alert('Lien copié !'))">
                    📋 Copier
                </button>
            </div>
            <p class="text-gray-500 mt-2">Vous pouvez envoyer ce lien au membre pour rejoindre la colocation.</p>
        </div>
    @endif
</div>
</x-app-layout>