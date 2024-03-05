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
                <h1>Zarządzaj zdjęciami dla: {{$vinyl->title}} - {{$vinyl->artist_name}}</h1>
                <div class="main-page-content-pictures">
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @elseif(session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif

                @foreach($vinyl->image_paths as $image)
                    <div class="main-page-content-pictures-image">
                        <img src="{{$image}}" alt="zdjęcie">
                        <form action="{{ route('delete.image')}}" method="post">
                            @csrf
                            @method('DELETE')
                            <input type="hidden" name="id" value="{{$vinyl->id}}">
                            <input type="hidden" name="image_path" value="{{$image}}">
                            <input type="submit" value="Usuń zdjęcie">
                        </form>
                    </div>
                @endforeach
                    <h3>Dodaj zdjęcie</h3>
                    <form action="{{ route('add.image')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" value="{{$vinyl->id}}">
                        <input type="file" name="picture" accept="image/*" required>
                        <br><br>
                        <input type="submit" value="Dodaj zdjęcie">
                        <br><br>
                    </form>
                </div>
            </div>
        </div>
    </main>
    @include('partials.footer')
</body>
</html>
