<x-layout>
    <div class="container-fluid">
        <div class="row py-5 justify-content-center align-items-center text-center">
            <div class="col-12">
                <h1 class="displsy-1">Risultati per la ricerca <span class="fst-italic"> {{$query}}</span></h1>
            </div>
        </div>
        <div class="row height-custom justify-content-center py-5 align-items-center">
            @forelse ($articles as $article )
                <div class="col-12 col-md-3">
                    <x-card :article='$article' />
                </div>
            @empty
                <div class="col-12">
                    <h3 class="text-center">
                        Nessun articolo corrisponde alla tua ricerca
                    </h3>
                </div>
            @endforelse
        </div>
    </div>
</x-layout>