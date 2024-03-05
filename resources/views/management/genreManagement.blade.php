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
                <h1>Kategorie</h1>
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @elseif(session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif
                <form action="{{url('/dodaj_kategorie')}}" method="get">
                    <input type="submit" value="Dodaj kategorię">
                </form>
                <ul>
                @foreach($genres as $genre)
                <li>
                        <a href="">{{ $genre->id }}: {{ $genre->description }}</a>
                        <br>
                        <a class="fun-link" href="{{url('/modyfikuj_kategorie')}}/{{ $genre->id }}">Edytuj</a>
                        <a class="fun-link" href="{{url('/usun_kategorie')}}/{{ $genre->id }}">Usuń</a>
                </li>
                @endforeach
                </ul>
                
                
            </div>
        </div>
    </main>
    @include('partials.footer')
</body>
</html>