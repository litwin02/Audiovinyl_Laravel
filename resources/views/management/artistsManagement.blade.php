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
                <h1>Artyści</h1>
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @elseif(session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif
                <form action="{{url('/dodaj_artyste')}}" method="get">
                    <input type="submit" value="Dodaj artystę">
                </form>
                <ul>
                @foreach($artists as $artist)
                <li>
                        <a href="">{{ $artist->id }}: {{ $artist->name }}</a>
                        <br>
                        <a class="fun-link" href="{{url('/modyfikuj_artyste')}}/{{ $artist->id }}">Edytuj</a>
                        <a class="fun-link" href="{{url('/usun_artyste')}}/{{ $artist->id }}">Usuń</a>
                </li>
                @endforeach
                </ul>
                
                
            </div>
        </div>
    </main>
    @include('partials.footer')
</body>
</html>