@extends("layouts.skeleton")

@section("body")
    <div class="absolute inset-0 flex items-center justify-center">
        <x-card class="w-full max-w-md">
            <div class="text-4xl font-extrabold text-center mb-8 mt-4">
                <span class="bg-clip-text text-transparent bg-gradient-to-r from-blue-500 to-green-500">
                    RemoteManager Paul Gubbiotti
                </span>
            </div>
            <form method="POST" action="{{ URL::full() }}" class="flex flex-col space-y-4">
                @csrf
                <x-form-errors/>

                <div class="font-semibold pb-1">
                    <label class="label">Adresse e-mail</label>
                    <div class="control">
                        <x-input class="input" type="email" name="email" value="{{ old('email') }}"/>
                    </div>
                </div>

                <div class="font-semibold pb-1">
                    <label class="label">Mot de passe</label>
                    <div class="control">
                        <x-input class="input" type="password" name="password"/>
                    </div>
                </div>

                <div>
                    <x-button type="submit">
                        Connexion
                    </x-button>
                </div>
            </form>
        </x-card>
    </div>
@endsection
