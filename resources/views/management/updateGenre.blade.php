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
                <h1>Aktualizuj kategorię</h1>
                <form action="{{url('/modyfikuj_kategorie')}}" method="post">
                    @csrf
                    <label for="id">ID</label>
                    <input type="text" name="id" value="{{$genre->id}}" readonly></input>
                    <br><br>

                    <label for="description">Opis</label>
                    <input type="text" name="description" value="{{$genre->description}}"></input>
                    <br><br>

                    <button type="submit">Aktualizuj</button>
                    <br><br>
                </form>
                
                
            </div>
        </div>
    </main>
    @include('partials.footer')
</body>
</html>