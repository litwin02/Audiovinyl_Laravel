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
                <div class="main-page-my-account">
                    <h1>Użytkownicy tego wspaniałego sklepu</h1>
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{session('success')}}
                        </div>
                    
                    @endif
                    <div class="main-page-my-account-users">
                    @foreach($users as $user)
                        <div class="main-page-my-account-users-user">
                            <div class="main-page-my-account-users-user-info">
                                <div class="main-page-my-account-users-user-info-_name">
                                    <h2>{{$user->firstName}} {{$user->lastName}}</h2>
                                </div>
                                <div class="main-page-my-account-users-user-info-email">
                                    <h2>Email: {{$user->email}}</h2>
                                </div>
                                <div class="main-page-my-account-users-user-info-role">
                                    <h2>Rola: {{$user->role}}</h2>
                                </div>
                            </div>
                            <div class="main-page-my-account-users-user-buttons">
                                <div class="main-page-my-account-users-user-buttons-edit">
                                    <a href="{{route('admin.users.edit', $user->id)}}"><button>Edytuj</button></a>
                                </div>
                                <div class="main-page-my-account-users-user-buttons-delete">
                                    <form action="{{route('admin.users.delete', $user)}}" method="POST" onsubmit="return confirm('Czy jesteś pewien, że chcesz usunąć tego użytkownika?');">
                                        @csrf
                                        {{method_field('DELETE')}}
                                        <button type="submit">Usuń</button>
                                    </form>
                                </div>
                            </div>
                        </div>           
                    @endforeach
                    </div>
                </div>
            </div>
        </div>
    </main>
    @include('partials.footer')
</body>
</html>