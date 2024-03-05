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
                <h1>Dodaj płytę (zdjecia płyty możesz dodać po utworzeniu płyty)</h1>
                <form action="{{url('/dodaj_winyl')}}" method="post">
                    @csrf
                    
                    <label for="title">Tytuł</label>
                    <input type="text" name="title" value="Podaj tytuł..."></input>
                    <br><br>

                    <label for="description">Opis</label>
                    <textarea id="description" name="description" rows="4" cols="50">Podaj opis...</textarea>
                    <br><br>

                    <label for="artist_id">Artysta</label>
                    <select name="artist_id" id="artist_id">
                        @foreach($artists as $artist)
                            <option value="{{$artist->id}}">{{$artist->name}}</option>
                        @endforeach
                    </select>
                    <br><br>

                    <label for="genre_id">Gatunek</label>
                    <select name="genre_id" id="genre_id">
                        @foreach($genres as $genre)
                            <option value="{{$genre->id}}">{{$genre->description}}</option>
                        @endforeach
                    </select>
                    <br><br>

                    <label for="quantity">Ilość(stan magazynowy)</label>
                    <input type="text" name="quantity" value="Podaj ilość..."></input>
                    <br><br>
                    <label for="price">Cena</label>
                    <input type="text" name="price" value="Podaj cenę..."></input>
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