<nav x-data="{ open: false }" class="bg-white/80 backdrop-blur-xl  border-b rounded-2xl">
    <div class="max-w-7xl mx-auto px-6 sm:px-8 lg:px-10">
        <div class="flex justify-between h-20"> <!-- height أكبر -->

            <!-- Left: Logo + Links -->
            <div class="flex items-center space-x-8">
                <!-- Logo -->
                <a href="{{ route('dashboard') }}" class="flex items-center">
                    <x-application-logo class="block h-12 w-auto fill-current text-indigo-600" /> <!-- logo أكبر -->
                    <span class="ml-3 font-extrabold text-indigo-600 text-2xl">EasyColoc</span> <!-- text أكبر -->
                </a>

                <!-- Desktop Links -->
                <div class="hidden space-x-6 sm:flex text-lg font-semibold"> <!-- text أكبر -->
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{ __('Dashboard') }}
                    </x-nav-link>
                    <x-nav-link :href="route('colocation.index')" :active="request()->routeIs('colocations.*')">
                        {{ __('Colocations') }}
                    </x-nav-link>
                    <x-nav-link :href="route('profile.edit')" :active="request()->routeIs('profile.edit')">
                        {{ __('Profile') }}
                    </x-nav-link>
                </div>
            </div>

            <!-- Right: User Dropdown -->
            <div class="flex items-center space-x-6 text-lg font-medium"> <!-- font أكبر + spacing أكبر -->
                <span class="text-gray-700 font-medium">{{ auth()->user()->name }}</span>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                        class="py-3 px-6 rounded-xl font-semibold text-white bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 transition shadow-lg text-lg">
                        Logout
                    </button>
                </form>
            </div>

            <!-- Hamburger -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = !open" class="inline-flex items-center justify-center p-3 rounded-lg text-gray-500 hover:text-gray-700 hover:bg-white/50 focus:outline-none transition duration-200">
                    <svg class="h-7 w-7" stroke="currentColor" fill="none" viewBox="0 0 24 24"> <!-- svg أكبر -->
                        <path :class="{'hidden': open, 'inline-flex': !open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        <path :class="{'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>

        </div>
    </div>

    <!-- Responsive Menu -->
    <div :class="{'block': open, 'hidden': !open}" class="hidden sm:hidden bg-white/80 backdrop-blur-xl border-t border-white/30">
        <div class="pt-3 pb-4 space-y-2 text-lg font-medium"> <!-- text أكبر + spacing أكبر -->
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('colocation.index')" :active="request()->routeIs('colocations.*')">
                {{ __('Colocations') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('profile.edit')" :active="request()->routeIs('profile.edit')">
                {{ __('Profile') }}
            </x-responsive-nav-link>
        </div>

        <div class="pt-4 pb-2 border-t border-gray-200">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-2">
                <x-responsive-nav-link :href="route('profile.edit')" class="text-lg">
                    {{ __('Profile') }}
                </x-responsive-nav-link>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')" class="text-lg" onclick="event.preventDefault(); this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>