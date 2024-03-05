<header>
    <div class="login">
        
        @if(Auth::check())
        <a href="{{url('/moje-zamowienia')}}/{{Auth::user()->id}}">Moje zamówienia</a>
        <a href="{{url('/wyloguj')}}">Wyloguj się</a>
        @else
        <a href="{{url('/rejestracja')}}">Utwórz konto w sklepie</a>
        <a href="{{url('/zaloguj')}}">Zaloguj się</a>
        @endif
    </div>
    <div class="navigation">
        <div class="logo-search-cart">
            <div class="logo">
                <a href="{{url('/')}}">
                    <img src="https://foka.umg.edu.pl/~s48455/PROJEKT_PSI_PAW/Audiovinyl/public/images/logo.png" alt="logo" />
                </a>
            </div>
            <div class="search">
                <form class="form-inline" action="{{ url('/szukaj') }}" method="get">
                    @csrf
                    <input id="search" name="search" type="text" placeholder="Wyszukaj płyty..." />
                    <button type="submit"><svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="20" height="20" viewBox="0,0,256,256"
style="fill:#000000;">
<g fill="#ffffff" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal"><g transform="scale(5.12,5.12)"><path d="M21,3c-9.37891,0 -17,7.62109 -17,17c0,9.37891 7.62109,17 17,17c3.71094,0 7.14063,-1.19531 9.9375,-3.21875l13.15625,13.125l2.8125,-2.8125l-13,-13.03125c2.55469,-2.97656 4.09375,-6.83984 4.09375,-11.0625c0,-9.37891 -7.62109,-17 -17,-17zM21,5c8.29688,0 15,6.70313 15,15c0,8.29688 -6.70312,15 -15,15c-8.29687,0 -15,-6.70312 -15,-15c0,-8.29687 6.70313,-15 15,-15z"></path></g></g>
</svg></button>
                </form>
            </div>
            <div class="shopping-cart">
                <a href="./koszyk">
                    Koszyk: <span>{{Cart::getTotalQuantity()}}</span>
                </a>
            </div>
        </div>
        <nav>
            <ul>
                @if(Auth::check() && Auth::user()->role == 'admin')
                <li><a href="{{url('/zarzad-winyle')}}">Zarządzaj winylami</a></li>
                <li><a href="{{url('/zarzad-kategorie')}}">Zarządzaj kategoriami</a></li>
                <li><a href="{{url('/zarzad-artysci')}}">Zarządzaj artystami</a></li>
                <li><a href="{{url('/zarzad-zamowienia')}}">Zarządzaj zamówieniami</a></li>
                <li><a href="{{url('/zarzad-uzytkownicy')}}">Zarządzaj użytkownikami</a></li>
                @else
                <li><a class="nav-first" href="{{url('/plyty')}}">Wszystkie płyty</a></li>
                <li><a href="{{url('/kategorie')}}">Kategorie</a></li>
                <li><a href="{{url('/artysci')}}">Artyści</a></li>
                <li><a href="{{url('/o-sklepie')}}">O sklepie</a></li>
                <li><a class="nav-last" href="{{url('/kontakt')}}">Kontakt</a></li>
                @endif
            </ul>
        </nav>
    </div>
</header>