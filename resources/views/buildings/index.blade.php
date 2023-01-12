@extends("layouts.app")

@section("content")
    <div class="flex flex-col space-y-4">
        <h1 class="text-5xl font-extrabold">
            Gestion des bâtiments
        </h1>

        <div>
            <a href="/buildings/create" class="bg-blue-500 px-5 py-2 rounded-full font-medium text-white transition hover:bg-blue-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                Nouveau bâtiment
            </a>
        </div>

        <x-card class="divide-y py-0">
            @forelse($buildings as $building)
                <div class="py-4 flex items-center justify-between">
                    <div>
                        <span class="font-medium">{{ $building->name }}</span> <span class="text-gray-500 text-xs">Capacité : {{ $building->capacity }}</span>
                    </div>
                    <div class="flex items-center space-x-2">
                        <a href="/buildings/{{ $building->id }}" class="bg-blue-100 px-5 py-1.5 text-sm rounded-full font-medium text-blue-700 transition hover:bg-blue-200 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                            Modifier
                        </a>
                        <a href="/buildings/{{ $building->id }}/delete" class="bg-red-100 px-5 py-1.5 text-sm rounded-full font-medium text-red-700 transition hover:bg-red-200 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                            Suppr.
                        </a>
                    </div>
                </div>
            @empty
                <div class="text-center text-xl text-gray-400 py-16">
                    Aucun bâtiment
                </div>
            @endforelse
        </x-card>
    </div>
@endsection
