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
                <h1>Wyniki wyszukiwania dla: {{$search}}</h1>
                        <h2>Znaleziono {{count($vinyls)}} wyników</h2>
                    <br>
                <div class="main-page-content-new">
                    @if(!empty($vinyls))
                        
                        @foreach($vinyls as $vinyl)
                            <div class="main-page-content-new-product">
                                <a href="./winyl/{{ $vinyl->id }}">
                                <img src="{{$vinyl->image_paths[0]}}" alt="{{ $vinyl->title }} - {{$vinyl -> artist_name}} image">
                                <h2>{{ $vinyl->title }} - {{$vinyl -> artist_name}}</h2>
                                <h3>{{$vinyl->price}} zł</h3>
                                <form action="{{ route('cart.store') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $vinyl->id }}">
                                    <input type="hidden" name="title" value="{{ $vinyl->title }}">
                                    <input type="hidden" name="description" value="{{ $vinyl->description }}">
                                    <input type="hidden" name="artist_id" value="{{ $vinyl->artist_id }}">
                                    <input type="hidden" name="genre_id" value="{{ $vinyl->genre_id }}">
                                    <input type="hidden" name="price" value="{{ $vinyl->price }}">
                                    <input type="hidden" name="quantity" value="1">
                                    <input type="hidden" name="image_paths" value="{{ $vinyl->image_paths[0] }}">
                                    <input type="hidden" name="artist_name" value="{{ $vinyl->artist_name }}">
                                    <input type="hidden" name="genre_description" value="{{ $vinyl->genre_description }}">
                                    <button type="submit">Dodaj do koszyka</button>
                                </form>
                                </a>
                            </div>
                        @endforeach
                    @else
                        <h1>Nie znaleziono żadnej płyty dla zapytania: {{$search}}</h3>
                    @endif
                    
            </div>
        </div>
    </main>
    @include('partials.footer')
</body>
</html>