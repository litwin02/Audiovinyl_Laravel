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
                <h1>Edytuj użytkownika</h1>
                <form action="{{route('admin.users.update')}}" method="post">
                    @csrf
                    <label for="id">ID</label>
                    <input type="text" name="id" value="{{$user->id}}" readonly></input>
                    <br><br>

                    <label for="email">Email użytkownika</label>
                    <input type="text" name="email" value="{{$user->email}}"></input>
                    <br><br>
                    
                    <label for="firstName">Imię</label>
                    <input type="text" name="firstName" value="{{$user->firstName}}"></input>
                    <br><br>

                    <label for="lastName">Nazwisko</label>
                    <input type="text" name="lastName" value="{{$user->lastName}}"></input>
                    <br><br>

                    <label for="role">Rola</label>
                    
                    <select name="role" id="role">
                        <option value="admin" @if($user->role == 'admin') selected @endif>Administrator</option>
                        <option value="user" @if($user->role == 'user') selected @endif>Klient</option>
                    </select>
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