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
                <h1>{{$header}}</h1>
                <div class="main-page-content-new">
                    <div class="main-page-content-vinyl-detail">
                        <!-- Slideshow container -->
                        <div class="slideshow-container">
                        @foreach($vinyl->image_paths as $image)
    
                            <!-- Full-width images with number and caption text -->
                            <div class="mySlides fade">
                                <div class="numbertext">1 / {{count($vinyl->image_paths)}}</div>
                                <img src="{{$image}}" style="width:100%">
                            </div>
    
                            <!-- Next and previous buttons -->
                            <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
                            <a class="next" onclick="plusSlides(1)">&#10095;</a>
                        </div>
                            <br>
                            <!-- The dots/circles -->
                        <div style="text-align:center">
                            @for($i = 1; $i <= count($vinyl->image_paths); $i++)
                                <span class="dot" onclick="currentSlide({{$i}})"></span>
                            @endfor
                        </div>
                        @endforeach
                    </div>
                    
                    <div class="main-page-content-new-product">
                        <h3>Opis</h3>
                        <p>{{$vinyl->description}}</p>
                        <p>Ilość na magazynie: {{$vinyl->quantity}}</p>
                        <p>Cena: {{$vinyl->price}} zł</p>
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
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script src="{{ URL::asset('slideshow.js') }}"></script>
    @include('partials.footer')
</body>
</html>