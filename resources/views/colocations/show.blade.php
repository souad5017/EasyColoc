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
                    <p class="mt-1 text-gray-500 text-sm">Créée par:
                        @php $owner = $colocation->owner;@endphp
                        @if($owner && $owner->id === auth()->id())
                        {{ $colocation->owner->name ?? 'Inconnu' }} (vous)
                        @else
                        {{ $owner->name ?? '—' }} @endif
                    </p>
                    <p class="text-gray-500 text-sm">Date: {{ $colocation->created_at->format('d/m/Y') }}</p>
                </div>
                @if ( $colocation->status == 'active' )
                <div class="flex gap-2 mt-4 sm:mt-0">
                    <a href="{{ route('members.create', $colocation->id) }}" class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 transition">Ajouter Membre</a>
                    <a href="{{ route('depenses.create', $colocation->id) }}" class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition">Ajouter Dépense</a>
                    <a href="{{ route('categories.index', $colocation->id) }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">Ajouter Catégorie</a>
                </div>
                @endif

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

        <div x-data="{ tab: 'membres' }" class="space-y-4">

            <!-- Tabs -->
            <div class="bg-white/80 backdrop-blur-xl shadow-lg rounded-2xl p-4 flex space-x-6">
                <button @click="tab = 'membres'"
                    :class="tab === 'membres' ? 'bg-indigo-100 text-indigo-600' : 'text-gray-700 hover:text-indigo-600 hover:bg-indigo-100'"
                    class="px-4 py-2 rounded-lg font-semibold transition">
                    Membres
                </button>

                <button @click="tab = 'depenses'"
                    :class="tab === 'depenses' ? 'bg-indigo-100 text-indigo-600' : 'text-gray-700 hover:text-indigo-600 hover:bg-indigo-100'"
                    class="px-4 py-2 rounded-lg font-semibold transition">
                    Dépenses
                </button>

                <button @click="tab = 'invitations'"
                    :class="tab === 'invitations' ? 'bg-indigo-100 text-indigo-600' : 'text-gray-700 hover:text-indigo-600 hover:bg-indigo-100'"
                    class="px-4 py-2 rounded-lg font-semibold transition">
                    Invitations
                </button>
                <button @click="tab = 'categories'"
                    :class="tab === 'categories' ? 'bg-indigo-100 text-indigo-600' : 'text-gray-700 hover:text-indigo-600 hover:bg-indigo-100'"
                    class="px-4 py-2 rounded-lg font-semibold transition">
                    Categories
                </button>
            </div>

            <!-- Tab Content -->
            <div class="bg-white/80 backdrop-blur-xl shadow-lg rounded-2xl p-4">
                <div x-show="tab === 'membres'">
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
                <div x-show="tab === 'depenses'" x-cloak>
                    <h4 class="text-lg font-semibold mb-3">Dépenses</h4>
                    @if($colocation->depenses && $colocation->depenses->isNotEmpty())
                    <ul class="divide-y divide-gray-200">
                        @foreach($colocation->depenses as $depense)
                        <li class="flex justify-between items-center py-2">

                            <div>
                                <span class="text-gray-700">{{ $depense->label }}</span>
                                <span class="text-gray-700 font-semibold ml-4">
                                    {{ $depense->amount }} MAD
                                </span>
                            </div>

                            <div class="flex gap-2">

                                @if ($depense->user_id == Auth::id())
                                <form action="{{ route('depenses.destroy', [$colocation->id, $depense->id]) }}"
                                    method="POST"
                                    onsubmit="return confirm('Voulez-vous vraiment supprimer cette dépense ?');">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                        class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded-lg text-sm shadow">
                                        Supprimer
                                    </button>
                                </form>
                                @endif
                                <!-- Button Update -->
                                <a href="{{ route('depenses.edit', [$colocation->id, $depense->id]) }}"
                                    class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded-lg text-sm shadow">
                                    Modifier
                                </a>

                                <!-- Button Delete -->



                            </div>

                        </li>
                        @endforeach
                    </ul>
                    @else
                    <p class="text-gray-500">Aucune dépense pour le moment.</p>
                    @endif
                </div>


                <div x-show="tab === 'invitations'" x-cloak>
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
                <div x-show="tab === 'categories'" x-cloak>
                    <h4 class="text-lg font-semibold mb-3">Catégories</h4>

                    @if($colocation->categories && $colocation->categories->isNotEmpty())
                    <ul class="divide-y divide-gray-200">
                        @foreach($colocation->categories as $category)
                        <li class="flex justify-between items-center py-2">
                            <span class="text-gray-700">{{ $category->name }}</span>
                            <div class="flex gap-2">
                                @if (!$category->is_global)
                                <a href="{{ route('categories.edit', $category->id) }}"
                                    class="px-3 py-1 bg-yellow-400 text-white rounded-lg hover:bg-yellow-500">
                                    Modifier
                                </a>

                                <!-- Bouton Supprimer -->
                                <form action="{{ route('categories.destroy', $category->id) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette catégorie ?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="px-3 py-1 bg-red-600 text-white rounded-lg hover:bg-red-700">
                                        Supprimer
                                    </button>
                                </form>
                                @endif

                            </div>
                        </li>
                        @endforeach
                    </ul>
                    @else
                    <p class="text-gray-500">Aucune catégorie disponible.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>