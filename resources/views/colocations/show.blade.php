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
                <button @click="tab = 'payments'"
                    :class="tab === 'payments' ? 'bg-indigo-100 text-indigo-600' : 'text-gray-700 hover:text-indigo-600 hover:bg-indigo-100'"
                    class="px-4 py-2 rounded-lg font-semibold transition">
                    Payments
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
                <div x-show="tab === 'membres'" x-cloak>
                    <h4 class="text-lg font-semibold mb-3">Membres</h4>

                    @if($colocation->users && $colocation->users->isNotEmpty())
                    <div class="overflow-x-auto">
                        <table class="min-w-full bg-white shadow rounded-lg divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-500 uppercase tracking-wider">Nom</th>
                                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-500 uppercase tracking-wider">Rôle</th>
                                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-500 uppercase tracking-wider">Montant dû (MAD)</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($balance as $row )
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-gray-700">{{$row['user']->id != Auth::id()? $row['user']->name : 'Vous' }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium {{ $row['user']->pivot->role == 'owner' ? 'text-indigo-600' : 'text-gray-500' }}">
                                        {{ ucfirst($row['user']->pivot->role) }}
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap text-gray-700 font-semibold">
                                        @if($row['user']->id != Auth::id() )
                                        <span class="{{$row['balance'] > 0 ? 'text-emerald-600 ' : 'text-red-600' }}  bg-emerald-50 px-3 py-1 rounded-full text-xs font-bold">{{ number_format($row['balance'], 2) }} DH</span>

                                        @else
                                        <span class="text-gray-400 italic text-sm">C'est vous</span>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @else
                    <p class="text-gray-500">Aucun membre pour le moment.</p>
                    @endif
                </div>
                <div x-show="tab === 'depenses'" x-cloak>
                    <h4 class="text-lg font-semibold mb-3">Dépenses</h4>

                    @if($colocation->depenses && $colocation->depenses->isNotEmpty())
                    <div class="overflow-x-auto">
                        <table class="min-w-full bg-white shadow rounded-lg divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-500 uppercase tracking-wider">
                                        Dépense
                                    </th>
                                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-500 uppercase tracking-wider">
                                        Montant (MAD)
                                    </th>
                                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-500 uppercase tracking-wider">
                                        Créée par
                                    </th>
                                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-500 uppercase tracking-wider">
                                        Créée le
                                    </th>
                                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-500 uppercase tracking-wider">
                                        Actions
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($colocation->depenses->sortByDesc('created_at') as $depense)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-gray-700">{{ $depense->label }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-gray-700 font-semibold">{{ $depense->amount }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-gray-500 text-sm">
                                        {{ $depense->user->name}}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-gray-500 text-sm">
                                        {{ $depense->created_at->format('d/m/Y H:i') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap flex gap-2">
                                        @if ($depense->user_id == Auth::id())
                                        <!-- Modifier -->
                                        <a href="{{ route('depenses.edit', [$colocation->id, $depense->id]) }}"
                                            class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded-lg text-sm shadow">
                                            Modifier
                                        </a>

                                        <!-- Supprimer -->
                                        <form action="{{ route('depenses.destroy', [$colocation->id, $depense->id]) }}"
                                            method="POST"
                                            onsubmit="return confirm('Voulez-vous vraiment supprimer cette dépense ?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="bg-green-600 hover:bg-red-600 text-white px-3 py-1 rounded-lg text-sm shadow">
                                                Supprimer
                                            </button>
                                        </form>
                                        @else
                                        <span class="text-gray-400 italic text-sm">Non modifiable</span>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
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
                <div x-show="tab === 'payments'" x-cloak>
                    <h4 class="text-lg font-semibold mb-3">Paiements</h4>
                    @if($toReceive->count() > 0 || $toPay->count() > 0)

                    <section class="mt-8">

                        <div class="overflow-x-auto rounded-3xl border border-gray-200 shadow-sm">
                            <table class="min-w-full text-sm">

                                <thead class="bg-gray-100">
                                    <tr class="text-left uppercase tracking-wider text-gray-600 text-xs">
                                        <th class="px-6 py-4">Type</th>
                                        <th class="px-6 py-4">De</th>
                                        <th class="px-6 py-4">À</th>
                                        <th class="px-6 py-4">Montant</th>
                                        <th class="px-6 py-4 text-center">Action</th>
                                    </tr>
                                </thead>

                                <tbody class="divide-y divide-gray-200 bg-white">

                                    @foreach($toReceive as $settlement)
                                    <tr class="hover:bg-green-600/5 transition">

                                        <td class="px-6 py-4 font-bold text-green-600">
                                            À recevoir
                                        </td>

                                        <td class="px-6 py-4 text-gray-900">
                                            {{ $settlement->sender->name }}
                                        </td>

                                        <td class="px-6 py-4 text-gray-500">
                                            Moi
                                        </td>

                                        <td class="px-6 py-4 font-extrabold text-green-600">
                                            {{ number_format($settlement->amount, 2) }} DH
                                        </td>

                                        <td class="px-6 py-4 text-center">
                                            <form method="POST" action="{{ route('settlements.paid', $settlement->id) }}">
                                                @csrf
                                                <button type="submit"
                                                    class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white text-xs font-bold rounded-xl transition uppercase tracking-wider">
                                                    Confirmer
                                                </button>
                                            </form>
                                        </td>

                                    </tr>
                                    @endforeach



                                    @foreach($toPay as $settlement)
                                    <tr class="hover:bg-yellow-500/5 transition">

                                        <td class="px-6 py-4 font-bold text-red-500">
                                            À payer
                                        </td>

                                        <td class="px-6 py-4 text-gray-500">
                                            Moi
                                        </td>

                                        <td class="px-6 py-4 text-gray-900">
                                            {{ $settlement->receiver->name }}
                                        </td>

                                        <td class="px-6 py-4 font-extrabold text-red-500">
                                            {{ number_format($settlement->amount, 2) }} DH
                                        </td>

                                        <td class="px-6 py-4 text-center">
                                            <button disabled
                                                class="px-4 py-2 bg-gray-500 text-white text-xs font-bold rounded-xl cursor-not-allowed uppercase tracking-wider">
                                                En attente
                                            </button>
                                        </td>

                                    </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>

                    </section>

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