@php
    $isAdmin = Auth::user()->isAdmin();

    $linkBase = 'inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium transition duration-150 ease-in-out';
    $linkActive = 'border-[#c9a45c] text-white';
    $linkIdle = 'border-transparent text-slate-300 hover:text-white hover:border-[#c9a45c]/60';

    $respBase = 'block ps-3 pe-4 py-2 border-l-4 text-base font-medium transition duration-150 ease-in-out';
    $respActive = 'border-[#c9a45c] text-white bg-white/5';
    $respIdle = 'border-transparent text-slate-300 hover:text-white hover:bg-white/5';
@endphp

<nav x-data="{ open: false }" class="bg-[#0f1c2e] border-b-2 border-[#c9a45c]">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}" class="font-display text-2xl tracking-wide text-white">
                        Stock<span class="text-[#c9a45c]">ly</span>
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    @if ($isAdmin)
                        <a href="{{ route('admin.dashboard') }}"
                            class="{{ $linkBase }} {{ request()->routeIs('admin.dashboard') ? $linkActive : $linkIdle }}">
                            Dashboard
                        </a>
                        <a href="{{ route('admin.categories.index') }}"
                            class="{{ $linkBase }} {{ request()->routeIs('admin.categories.*') ? $linkActive : $linkIdle }}">
                            Kategori
                        </a>
                        <a href="{{ route('admin.products.index') }}"
                            class="{{ $linkBase }} {{ request()->routeIs('admin.products.*') ? $linkActive : $linkIdle }}">
                            Produk
                        </a>
                    @else
                        <a href="{{ route('user.dashboard') }}"
                            class="{{ $linkBase }} {{ request()->routeIs('user.dashboard') ? $linkActive : $linkIdle }}">
                            Dashboard
                        </a>
                        <a href="{{ route('user.products.index') }}"
                            class="{{ $linkBase }} {{ request()->routeIs('user.products.*') ? $linkActive : $linkIdle }}">
                            Produk
                        </a>
                    @endif
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-slate-200 bg-transparent hover:text-white focus:outline-none transition ease-in-out duration-150">
                            <div>{{ Auth::user()->name }}</div>

                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-slate-300 hover:text-white hover:bg-white/10 focus:outline-none transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            @if ($isAdmin)
                <a href="{{ route('admin.dashboard') }}"
                    class="{{ $respBase }} {{ request()->routeIs('admin.dashboard') ? $respActive : $respIdle }}">
                    Dashboard
                </a>
                <a href="{{ route('admin.categories.index') }}"
                    class="{{ $respBase }} {{ request()->routeIs('admin.categories.*') ? $respActive : $respIdle }}">
                    Kategori
                </a>
                <a href="{{ route('admin.products.index') }}"
                    class="{{ $respBase }} {{ request()->routeIs('admin.products.*') ? $respActive : $respIdle }}">
                    Produk
                </a>
            @else
                <a href="{{ route('user.dashboard') }}"
                    class="{{ $respBase }} {{ request()->routeIs('user.dashboard') ? $respActive : $respIdle }}">
                    Dashboard
                </a>
                <a href="{{ route('user.products.index') }}"
                    class="{{ $respBase }} {{ request()->routeIs('user.products.*') ? $respActive : $respIdle }}">
                    Produk
                </a>
            @endif
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-3 border-t border-white/10">
            <div class="px-4">
                <div class="font-medium text-base text-white">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-slate-400">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <a href="{{ route('profile.edit') }}" class="{{ $respBase }} {{ $respIdle }}">
                    Profile
                </a>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="{{ $respBase }} {{ $respIdle }} w-full text-left">
                        Log Out
                    </button>
                </form>
            </div>
        </div>
    </div>
</nav>