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
                <h1>Dodaj artystę</h1>
                <form action="{{url('/dodaj_artyste')}}" method="post">
                    @csrf
                    <label for="name">Nazwa artysty</label>
                    <input type="text" name="name" value="Podaj nazwę artysty..."></input>
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