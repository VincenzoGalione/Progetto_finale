<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Navbar</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{route('homepage')}}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{route('article.index')}}">Tutti gli articoli</a>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Categorie
                    </a>
                    <ul class="dropdown-menu">
                        @foreach ($categories as $category )
                            <li><a class="dropdown-item text-capitalize" 
                                href="{{route('byCategory' , ['category' => $category])}}">{{$category->name}}</a>
                            </li>
                            @if (!$loop->last)
                                <hr class="dropdown-divider">
                            @endif
                        @endforeach
                    </ul>
                </li>

                @auth
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Ciao, {{Auth::user()->name}}
                        </a>
                        <ul class="dropdown-menu">
                            <form  action="{{route('logout')}}" method="POST">
                                @csrf
                               <button class="nav-link" type="submit">Logout</button>
                            </form>    
                            <li><a class="dropdown-item" href="{{route('create.article')}}">Crea articolo</a></li>
                        </ul>
                    </li>
                    @if (Auth::user()->is_revisor)
                        <li class="naw-item">
                            <a class="nav-link btn btn-outline-success btn-sm position-relative w-sm-25 " 
                                href="{{route('revisor.index')}}">Zona revisore 
                                <span 
                                 class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger mt-1">
                                 {{\App\Models\Article::toBeRevisedCount()}}     
                                </span>
                            </a>
                        </li>   
                    @endif
                @else
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Ciao, Utente!
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{route('login')}}">Login</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="{{route('register')}}">Registrati</a></li>
                        </ul>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>