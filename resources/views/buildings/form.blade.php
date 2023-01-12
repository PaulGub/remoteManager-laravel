@extends("layouts.app")

@section("content")
    <div class="flex flex-col space-y-4">
        <h1 class="text-5xl font-extrabold">
            @if (isset($building) && $building->exists)
                Modifier un bâtiment
            @else
                Nouveau bâtiment
            @endif
        </h1>

        <x-card class="max-w-lg w-full mx-auto">
            <form method="POST" action="{{ URL::full() }}" class="flex flex-col space-y-4">
                @csrf
                <x-form-errors />
                @if(session()->has('message'))
                    <div class="alert alert-success">
                        {{ session()->get('message') }}
                    </div>
                @endif
                <div>
                    <div class="font-semibold pb-1">
                        <label for="name">Nom</label>
                    </div>
                    <x-input name="name" id="name" value="{{ isset($building) ? $building->name : '' }}" />
                </div>
                <div>
                    <div class="font-semibold pb-1">
                        <label for="capacity">Capacité maximale</label>
                    </div>
                    <x-input name="capacity" id="capacity" type="number" min="1" value="{{ isset($building) ? $building->capacity : '' }}" />
                </div>
                <div class="flex items-center space-x-2">
                    <x-button type="submit">
                        @if (isset($building) && $building->exists)
                            Enregistrer
                        @else
                            Créer
                        @endif
                    </x-button>
                    <a href="/buildings" class="bg-gray-100 px-5 py-2 rounded-full font-medium text-gray-800 transition hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                        Annuler
                    </a>
                </div>
            </form>
        </x-card>
    </div>
@endsection
