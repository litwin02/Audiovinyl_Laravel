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
            @if ($errors->any())
                <div class="main-page-error">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
                <h1>Edytuj artystę</h1>
                <form action="{{url('/modyfikuj_artyste')}}" method="post">
                    @csrf
                    <label for="id">ID</label>
                    <input type="text" name="id" value="{{$artist->id}}" readonly></input>
                    <br><br>

                    <label for="name">Nazwa artysty</label>
                    <input type="text" name="name" value="{{$artist->name}}"></input>
                    <br><br>

                    <button type="submit">Edytuj</button>
                    <br><br>
                </form>
                
                
            </div>
        </div>
    </main>
    @include('partials.footer')
</body>
</html>