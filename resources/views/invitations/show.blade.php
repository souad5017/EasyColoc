<x-app-layout>
    <div class="bg-slate-50 text-slate-800 min-h-screen">
        <main class="max-w-xl mx-auto px-4 py-12">
            <div class="bg-white border border-slate-200 rounded-2xl shadow-sm p-6 space-y-5">
                <h1 class="text-2xl font-bold">Invitation</h1>
                <div class="space-y-2 text-sm">


@if(session('msg'))
    <div class="mb-4 px-4 py-3 rounded-lg bg-emerald-100 text-emerald-700 border border-emerald-300">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="mb-4 px-4 py-3 rounded-lg bg-red-100 text-red-700 border border-red-300">
        {{ session('error') }}
    </div>
@endif
                    <p><span class="font-medium">Colocation:</span> {{$colocation->name}}</p>
                    <p><span class="font-medium">Invited
                            Email:</span> {{$invitation->email}}</p>
                    <p><span class="font-medium">Status:</span> pendding</p>
                </div>
                <div class="flex gap-3 pt-2">

                    <form action="{{route('invitations.accept' , $invitation->token)}}" method="post">
                        @csrf
                        <button type="submit"
                            class="px-4 py-2 rounded-lg bg-emerald-600 text-white font-medium hover:bg-emerald-700">
                            Accept Invitation </button>
                    </form>
                    <form action="#" method="post"> <button type="submit"
                            class="px-4 py-2 rounded-lg bg-rose-600 text-white font-medium hover:bg-rose-700">
                            Decline </button> </form>
                </div>
                <p class="text-xs text-slate-500 pt-1"> Demo flow: user accepts
                    invitation and becomes member. </p>
            </div>
        </main>
    </div>
</x-app-layout>