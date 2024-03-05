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
                <div class="main-page-content-cart">
                @if ($message = Session::get('success'))
                          <div class="p-4 mb-3 bg-green-400 rounded">
                              <p class="text-green-800">{{ $message }}</p>
                          </div>
                @elseif ($message = Session::get('error'))
                          <div class="p-4 mb-3 bg-red-400 rounded">
                              <p class="text-red-800">{{ $message }}</p>
                          </div>
                      @endif
                <h1>Koszyk</h1>
                @if(Cart::isEmpty())
                    <p>Brak produktów w koszyku</p>
                @else
                <table>
                    <thead>
                        <tr>
                            <th></th>
                            <th>Tytuł</th>
                            <th>Ilość</th>
                            <th>Cena</th>
                            <th>Usuń</th>
                        </tr>
                    </thead>    
                    <tbody>
                        @foreach($cartItems as $cartItem)
                        <tr>
                            <td><img src="{{ $cartItem->attributes->image_paths }}" alt="Okładka albumu"></td>
                            <td>{{ $cartItem->name }}</td>
                            <td>
                                <form action="{{ route('cart.update') }}" method="POST">
                                    @csrf
                                    <input type="hidden" value="{{ $cartItem->id }}" name="id">
                                    <input name="quantity" type="number" value="{{ $cartItem->quantity }}">
                                    <input type="submit" value="Zmień">
                                </form>
                            </td>
                            <td>{{ $cartItem->price }} zł</td>
                            <td>
                                <form action="{{ route('cart.remove') }}" method="POST">
                                    @csrf
                                    <input type="hidden" value="{{ $cartItem->id }}" name="id">
                                    <input type="submit" value="Usuń">
                                </form>
                            </td>
                        </tr>
                        @endforeach
                        <tr>
                            <td colspan="3"></td>
                            <td>Suma: {{ Cart::getTotal() }} zł</td>
                            <td>
                                @if(Auth::check())
                                <a href="{{route('cart.placeOrder')}}">Zamów</a>
                                @else
                                <a href="{{ route('login') }}">Zaloguj się, aby zamówić</a>
                                @endif
                            </td>
                        </tr>
                    </tbody>
                </table>
                @endif
                </div>
            </div>
        </div>
    </main>
    @include('partials.footer')
</body>
</html>