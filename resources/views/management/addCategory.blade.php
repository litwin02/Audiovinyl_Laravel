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
                <h1>Dodaj kategorię</h1>
                <form action="{{url('/dodaj_kategorie')}}" method="post">
                    @csrf
                    <label for="description">Opis</label>
                    <input type="text" name="description" value="Podaj opis..."></input>
                    <br><br>

                    <button type="submit">Dodaj</button>
                    <br><br>
                </form>
                
                
            </div>
        </div>
    </main>
    @include('partials.footer')
</body>
</html>