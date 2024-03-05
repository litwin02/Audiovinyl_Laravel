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
                <div class="main-page-content-artists">
                    @if($artists->count() > 0)
                        <ul>
                            @foreach($artists as $artist)
                                <li><a href="./artysci/{{$artist->id}}">{{ $artist->name }}</a></li>
                            @endforeach
                        </ul>
                    @else
                        <div class="main-page-content-artists">
                            <h2>Brak artystów</h2>
                        </div>
                    @endif
            </div>
        </div>
    </main>
    @include('partials.footer')
</body>
</html>