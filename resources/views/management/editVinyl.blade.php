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
                <h1>{{$vinyl->title}}</h1>

                <form action="{{url('/modyfikuj_winyl')}}" method="post">
                    @csrf
                    <label for="id">ID</label>
                    <input name="id" type="text" value="{{$vinyl->id}}" readonly></input>
                    <br><br>

                    <label for="title">Tytuł</label>
                    <input type="text" name="title" value="{{$vinyl->title}}"></input>
                    <br><br>

                    <label for="description">Opis</label>
                    <textarea id="description" name="description" rows="4" cols="50">{{$vinyl->description}}</textarea>
                    <br><br>

                    <label for="artist_id">Artysta</label>
                    <select name="artist_id" id="artist_id">
                        @foreach($artists as $artist)
                            <option value="{{$artist->id}}" @if($vinyl->artist_id == $artist->id) selected @endif>{{$artist->name}}</option>
                        @endforeach
                    </select>
                    <br><br>

                    <label for="genre_id">Gatunek</label>
                    <select name="genre_id" id="genre_id">
                        @foreach($genres as $genre)
                            <option value="{{$genre->id}}" @if($vinyl->genre_id == $genre->id) selected @endif>{{$genre->description}}</option>
                        @endforeach
                    </select>
                    <br><br>

                    <label for="quantity">Ilość(stan magazynowy)</label>
                    <input type="text" name="quantity" value="{{$vinyl->quantity}}"></input>
                    <br><br>
                    <label for="price">Cena</label>
                    <input type="text" name="price" value="{{$vinyl->price}}"></input>
                    <br><br>
                    <button type="submit">Zaktualizuj</button>
                    <br><br>
                </form>
                
                
            </div>
        </div>
    </main>
    @include('partials.footer')
</body>
</html>