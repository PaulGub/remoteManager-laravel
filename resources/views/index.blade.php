@extends("layouts.app")

@section("content")
    <div class="flex flex-col space-y-4">
        <h1 class="text-5xl font-extrabold">
            Tableau de bord
        </h1>

        <div class="bg-blue-100 rounded-lg p-4">

            <h2 class="underline pb-1">Réservation pour aujourd'hui ({{$today}})</h2>

            @forelse($buildings as $building)
                <span class="font-medium text-blue-700">{{ $building->name}}</span>
                @forelse($building->bookings as $booking)

                    @if($booking->date===$today)
                        <div>
                            <span class="pl-2">{{ $booking->user->name}}</span>
                        </div>
                    @endif
                @empty
                    <div class="text-gray-400">
                        Aucune réservations
                    </div>
                @endforelse
            @empty

            @endforelse
        </div>

        <div class="bg-red-100 rounded-lg p-4">

            <h2 class="underline pb-1">Réservation pour demain ({{$afterward}})</h2>

            @forelse($buildings as $building)
                <span class="font-medium text-blue-700">{{ $building->name}}</span>
                @forelse($building->bookings as $booking)

                    @if($booking->date===$afterward)
                        <div>
                            <span class="pl-2">{{ $booking->user->name}}</span>
                        </div>
                    @endif

                @empty
                    <div class="text-gray-400">
                        Aucune réservations
                    </div>
                @endforelse
            @empty

            @endforelse
        </div>

@endsection