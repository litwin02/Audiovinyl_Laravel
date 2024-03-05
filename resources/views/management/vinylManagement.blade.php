<!DOCTYPE html>
<html lang="pl">
<head>
    @include('partials.head')
</head>
<body>
    @include('partials.navbar')
    <main>
        <div class="main-page">
            <div class="main-page-content">
                <h1>Płyty</h1>
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @elseif(session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif
                <form action="{{url('/dodaj_winyl')}}" method="get">
                    <input type="submit" value="Dodaj płytę">
                </form>
                <ul>
                @foreach($vinyls as $vinyl)
                <li>
                        <a href="">{{ $vinyl->title }} - {{ $vinyl->artist_name }} {{ $vinyl->genre_description }} {{ $vinyl->price }}zł ILOŚĆ: {{ $vinyl->quantity }}
                        </a>
                        <br>
                        <a class="fun-link" href="{{url('/modyfikuj_winyl')}}/{{ $vinyl->id }}">Edytuj</a>
                        <a class="fun-link" href="{{url('/usun_winyl')}}/{{ $vinyl->id }}">Usuń</a>
                        <a class="fun-link" href="{{url('/zarzad_zdjeciami')}}/{{ $vinyl->id }}">Zarządzaj zdjęciami</a>
                </li>
                @endforeach
                </ul>
                
                
            </div>
        </div>
    </main>
    @include('partials.footer')
</body>
</html>