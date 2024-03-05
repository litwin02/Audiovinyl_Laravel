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
                    <h1>Zamówienia</h1>
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{session('success')}}
                        </div>
                    
                    @endif
                    <div class="main-page-my-account-orders">
                        @if(count($orders) == 0)
                            <div class="main-page-my-account-orders-order">
                                <div class="main-page-my-account-orders-order-header">
                                    <div class="main-page-my-account-orders-order-header-id">
                                        <p>Brak zamówień</p>
                                    </div>
                                </div>
                            </div>
                        @endif
                        @foreach($orders as $order)
                            <div class="main-page-my-account-orders-order">
                                <div class="main-page-my-account-orders-order-header">
                                    <div class="main-page-my-account-orders-order-header-user_id">
                                        <p>Id użytkownika: {{$order->user_id}}</p>
                                    </div>
                                    <div class="main-page-my-account-orders-order-header-id">
                                        <p>Id zamówienia: {{$order->id}}</p>
                                    </div>
                                    <div class="main-page-my-account-orders-order-header-date">
                                        <p>Data zamówienia: {{$order->created_at}}</p>
                                    </div>
                                    <div class="main-page-my-account-orders-order-header-status">
                                        <p>Status zamówienia: 
                                            @if(isset($order->status[0]))
                                                {{$order->status[0]->status == '0' ? 'Zamówienie anulowane' : ''}}
                                                {{$order->status[0]->status == '1' ? 'Zamówienie w realizacji' : ''}}
                                                {{$order->status[0]->status == '2' ? 'Zamówienie wysłane' : ''}}
                                            @endif
                                        </p>
                                    </div>
                                    <div class="main-page-my-account-orders-order-header-product">
                                        <p>Płyty: </p>
                                        @foreach($order->details as $detail)
                                            <div class="main-page-my-account-orders-order-header-product-item">
                                                <p>{{$detail->vinyl->artist_name}} - {{$detail->vinyl->title}} Ilość: {{$detail->quantity}}</p>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="main-page-my-account-orders-order-header-cancel">
                                        <form action="{{route('cancel.order')}}" method="POST" onsubmit="return confirm('Czy jesteś pewien, że chcesz anulować to zamówienie?');">
                                            @csrf
                                            <input type="hidden" name="order_id" value="{{$order->id}}">
                                            @if(isset($order->status[0]))
                                                @if($order->status[0]->status == '1')
                                                <button type="submit">Anuluj zamówienie</button>
                                                @endif
                                            @endif
                                            <br><br>
                                        </form>
                                    </div>
                                    <div class="main-page-my-account-orders-order-header-cancel">
                                        <form action="{{route('confirm.order')}}" method="POST" onsubmit="return confirm('Czy jesteś pewien, że chcesz sfinalizować to zamówienie?');">
                                            @csrf
                                            <input type="hidden" name="order_id" value="{{$order->id}}">
                                            @if(isset($order->status[0]))
                                                @if($order->status[0]->status == '1')
                                                <button type="submit">Sfinalizuj zamówienie</button>
                                                @endif
                                            @endif
                                            <br><br>
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