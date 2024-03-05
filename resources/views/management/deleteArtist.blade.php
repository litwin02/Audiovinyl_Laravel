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
                <h1>USUWANIE: {{$artist->name}}</h1>
                
                <h2>Czy na pewno chcesz usunąć tego artystę? USUWANIE KASKADOWE UWAGA!!!</h2>
                <div class="main-page-content-delete">
                    <form action="{{url('/usun_artyste')}}/{{$artist->id}}" method="POST">
                        <p>{{$artist->id}}</p>
                        <p>{{$artist->name}}</p>
                        @csrf
                        @method('DELETE')
                        <button type="submit">Tak, usuń</button>
                    </form>
                    <a class="fun-link" href="{{route('admin.artists')}}">Nie, wróć</a>
                </div>
                
            </div>
        </div>
    </main>
    @include('partials.footer')
</body>
</html>