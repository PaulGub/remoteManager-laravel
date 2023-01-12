@if ($errors->isNotEmpty())
    <div class="bg-red-100 border-l-4 border-red-600 p-4 text-red-700 text-sm">
        <div class="font-semibold">
            Veuillez corriger les erreurs suivantes pour poursuivre :
        </div>
        <ul class="list-disc ml-8">
            @foreach($errors->all() as $err)
                <li>
                    {{ $err }}
                </li>
            @endforeach
        </ul>
    </div>
@endif
