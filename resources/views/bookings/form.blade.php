@extends("layouts.app")

@section("content")
    <div class="flex flex-col space-y-4">
        <h1 class="text-5xl font-extrabold">
            @if (isset($booking) && $booking->exists)
                Modifier une réservation
            @else
                Nouvelle réservation
            @endif
        </h1>

        <x-card class="max-w-lg w-full mx-auto">
            <form method="POST" action="{{ URL::full() }}" class="flex flex-col space-y-4">
                @csrf
                <x-form-errors/>

                @if(session()->has('message'))
                    <div class="alert alert-success">
                        {{ session()->get('message') }}
                    </div>
                @endif

                <div>
                    <div class="font-semibold pb-1">
                        <label for="date">Date</label>
                    </div>

                    <x-input type="date" name="date" id="date" value={{$mytime}}/>

                </div>

                <div>
                    <div class="font-semibold pb-1">
                        <div class="font-semibold pb-1">
                            <label for="building_id">Bâtiment</label>
                        </div>

                        <select class="form-control" name="building_id" id="building_id" name="categorie_id">
                            @foreach($buildings as $building)
                                <option value="{{ $building->id }}">{{ $building->name }}</option>
                            @endforeach
                        </select>

                    </div>

                </div>
                <div class="flex items-center space-x-2">
                    <x-button type="submit">
                        @if (isset($booking) && $booking->exists)
                            Enregistrer
                        @else
                            Créer
                        @endif
                    </x-button>
                    <a href="/bookings"
                       class="bg-gray-100 px-5 py-2 rounded-full font-medium text-gray-800 transition hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                        Annuler
                    </a>
                </div>
            </form>
        </x-card>
    </div>
@endsection
