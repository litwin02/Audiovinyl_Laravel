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
                <h1>USUWANIE: {{$vinyl->title}}</h1>
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @elseif(session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif
                
                <h2>Czy na pewno chcesz usunąć tą płytę?</h2>
                <div class="main-page-content-delete">
                    <form action="{{url('/usun_winyl')}}/{{$vinyl->id}}" method="POST">
                        <p>{{$vinyl->id}}</p>
                        <p>{{$vinyl->title}}</p>
                        <p>{{$vinyl->artist_name}}</p>
                        @csrf
                        @method('DELETE')
                        <button type="submit">Tak, usuń</button>
                    </form>
                    <a class="fun-link" href="{{route('admin.vinyls')}}">Nie, wróć</a>
                </div>
                </ul>
                
                
            </div>
        </div>
    </main>
    @include('partials.footer')
</body>
</html>