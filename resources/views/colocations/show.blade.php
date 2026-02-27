<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-bold text-gray-800">
            Tableau de bord: {{ $colocation->name }}
        </h2>
    </x-slot>

    <div class="py-8 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

        <!-- Info Card -->
        <div class="bg-white shadow-md rounded-xl p-6 border border-gray-200">
            <div class="flex justify-between items-center flex-wrap">
                <div>
                    <h3 class="text-xl font-semibold text-gray-700">{{ $colocation->name }}</h3>
                    <span class="px-2 py-1 rounded-full {{ $colocation->status == 'active' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                        {{ ucfirst($colocation->status) }}
                    </span>
                    <p class="mt-1 text-gray-500 text-sm">Créée par: {{ $colocation->creator->name ?? 'Inconnu' }}</p>
                    <p class="text-gray-500 text-sm">Date: {{ $colocation->created_at->format('d/m/Y') }}</p>
                </div>

                <div class="flex gap-2 mt-4 sm:mt-0">
                    <a href="{{ route('members.create', $colocation->id) }}" class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 transition">Ajouter Membre</a>
                    <a href="" class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition">Ajouter Dépense</a>
                    <a href="" class="bg-purple-600 text-white px-4 py-2 rounded-lg hover:bg-purple-700 transition">Inviter</a>
                </div>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
            <div class="bg-white shadow-md rounded-xl p-6 border border-gray-200 text-center">
                <h5 class="text-gray-500 font-medium">Membres</h5>
                <p class="text-3xl font-bold">{{ $colocation->users?->count() ?? 0 }}</p>
            </div>
            <div class="bg-white shadow-md rounded-xl p-6 border border-gray-200 text-center">
                <h5 class="text-gray-500 font-medium">Dépenses</h5>
                <p class="text-3xl font-bold">{{ $colocation->depenses?->count() ?? 0 }}</p>
            </div>
            <div class="bg-white shadow-md rounded-xl p-6 border border-gray-200 text-center">
                <h5 class="text-gray-500 font-medium">Total</h5>
                <p class="text-3xl font-bold text-green-600">{{ $colocation->depenses?->sum('amount') ?? 0 }} MAD</p>
            </div>
        </div>

        <!-- Members List -->
        <div class="bg-white shadow-md rounded-xl p-6 border border-gray-200">
            <h4 class="text-lg font-semibold mb-3">Membres</h4>
            @if($colocation->users && $colocation->users->isNotEmpty())
                <ul class="divide-y divide-gray-200">
                    @foreach($colocation->users as $user)
                        <li class="flex justify-between items-center py-2">
                            <span class="text-gray-700">{{ $user->name }}</span>
                            <span class="text-sm font-medium {{ $user->pivot->role == 'owner' ? 'text-indigo-600' : 'text-gray-500' }}">
                                {{ ucfirst($user->pivot->role) }}
                            </span>
                        </li>
                    @endforeach
                </ul>
            @else
                <p class="text-gray-500">Aucun membre pour le moment.</p>
            @endif
        </div>

        <!-- Dépenses List -->
        <div class="bg-white shadow-md rounded-xl p-6 border border-gray-200">
            <h4 class="text-lg font-semibold mb-3">Dépenses</h4>
            @if($colocation->depenses && $colocation->depenses->isNotEmpty())
                <ul class="divide-y divide-gray-200">
                    @foreach($colocation->depenses as $depense)
                        <li class="flex justify-between items-center py-2">
                            <span class="text-gray-700">{{ $depense->title }}</span>
                            <span class="text-gray-700 font-semibold">{{ $depense->amount }} MAD</span>
                        </li>
                    @endforeach
                </ul>
            @else
                <p class="text-gray-500">Aucune dépense pour le moment.</p>
            @endif
        </div>

        <!-- Invitations List -->
        <div class="bg-white shadow-md rounded-xl p-6 border border-gray-200">
            <h4 class="text-lg font-semibold mb-3">Invitations</h4>
            @if($colocation->invitations && $colocation->invitations->isNotEmpty())
                <ul class="divide-y divide-gray-200">
                    @foreach($colocation->invitations as $inv)
                        <li class="flex justify-between items-center py-2">
                            <span class="text-gray-700">{{ $inv->email }}</span>
                            <span class="text-sm font-medium {{ $inv->accepted ? 'text-green-600' : 'text-gray-500' }}">
                                {{ $inv->accepted ? 'Acceptée' : 'En attente' }}
                            </span>
                        </li>
                    @endforeach
                </ul>
            @else
                <p class="text-gray-500">Aucune invitation envoyée.</p>
            @endif
        </div>

    </div>
</x-app-layout>