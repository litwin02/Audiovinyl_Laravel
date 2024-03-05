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
                <h1>Gatunki muzyczne</h1>
                <div class="main-page-content-genres">
                    @if($genres->count() > 0)
                        <ul>
                            @foreach($genres as $genre)
                                <li><a href="./kategorie/{{$genre->id}}">{{ $genre->description }}</a></li>
                            @endforeach
                        </ul>
                    @else
                        <div class="main-page-content-genres">
                            <h2>Brak gatunków muzycznych</h2>
                        </div>
                    @endif
            </div>
        </div>
    </main>
    @include('partials.footer')
</body>
</html>