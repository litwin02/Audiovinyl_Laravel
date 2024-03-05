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
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @elseif(session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif
                <h1>Nowości</h1>
                <div class="main-page-content-new">
                    @foreach($vinyls as $vinyl)
                    @if($vinyl->quantity > 0)
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
                                @if($vinyl->quantity > 0)
                                <button type="submit">Dodaj do koszyka</button>
                                @else
                                <button type="submit" disabled>Dodaj do koszyka</button>
                                @endif
                            </form>
                            </a>
                        </div>
                    @endif
                    @endforeach
                </div>
            </div>
        </div>
    </main>
    @include('partials.footer')
</body>
</html>