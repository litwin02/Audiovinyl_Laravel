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
                <h1>USUWANIE: {{$genre->description}}</h1>
                
                <h2>Czy na pewno chcesz usunąć tą kategorię? USUWANIE JEST KASKADOWE!!!!!</h2>
                <div class="main-page-content-delete">
                    <form action="{{url('/usun_kategorie')}}/{{$genre->id}}" method="POST">
                        <p>{{$genre->id}}</p>
                        <p>{{$genre->description}}</p>
                        @csrf
                        @method('DELETE')
                        <button type="submit">Tak, usuń</button>
                    </form>
                    <a class="fun-link" href="{{route('admin.genres')}}">Nie, wróć</a>
                </div>
                
            </div>
        </div>
    </main>
    @include('partials.footer')
</body>
</html>