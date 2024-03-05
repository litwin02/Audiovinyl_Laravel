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
                <div class="main-page-content-order">
                    <h1>Podsumowanie zamówienia</h1>

                    <div class="main-page-content-order-table">
                        <table>
                            <thead>
                                <tr>
                                    <th>Produkt</th>
                                    <th>Ilość</th>
                                    <th>Cena</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach(Cart::getContent() as $item)
                                    <tr>
                                        <td>{{$item['name']}}</td>
                                        <td>{{$item['quantity']}}</td>
                                        <td>{{$item['price']}} zł</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="main-page-content-order-table">
                            <table>
                                <thead>
                                    <tr>
                                        <th>Suma</th>
                                        <th>{{Cart::getTotal()}} zł</th>
                                    </tr>
                                </thead>
                            </table>
                            <br>
                        </div>
                    </div>
                    <form action="{{route('cart.storeOrder')}}" method="post">
                        @csrf
                            <input type="text" name="user_id" id="user_id" value="{{Auth::user()->id}}" hidden>
                            <div class="main-page-content-order-form-input">
                                <label for="address">Adres</label>
                                <input type="text" name="address" id="address" value="{{old('address')}}">
                                @error('address')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="main-page-content-order-form-input">
                                <label for="city">Miasto</label>
                                <input type="text" name="city" id="city" value="{{old('city')}}">
                                @error('city')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="main-page-content-order-form-input">
                                <label for="post_code">Kod pocztowy</label>
                                <input type="text" name="post_code" id="post_code" value="{{old('post_code')}}">
                                @error('post_code')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="main-page-content-order-form-input">
                                <button type="submit">Złóż zamowienie</button>
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
    @include('partials.footer')
</body>
</html>