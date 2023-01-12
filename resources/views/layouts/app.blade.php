@extends("layouts.skeleton")

@section("body")
    <div class="bg-white  shadow mb-8">
        <x-container class="flex items-center justify-between h-14">
            <div class="text-3xl font-extrabold">
                <a href="{{ route("index") }}" class="bg-clip-text text-transparent bg-gradient-to-r from-blue-500 to-green-500">
                    RemoteManager
                </a>
            </div>
            <div class="space-x-4">
                @if(Auth::user()->is_admin == 1)
                <x-nav-link href="/buildings">Bâtiments</x-nav-link>
                @endif

                    <x-nav-link href="/bookings">Réservations</x-nav-link>

                <x-nav-link :href="route('auth.logout')">Déconnexion ({{ Auth::user()->name }})</x-nav-link>


            </div>
        </x-container>
    </div>
    <x-container>
        @yield("content")
    </x-container>
@endsection
