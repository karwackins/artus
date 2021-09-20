<div class="card h-100">
    <div class="card-body">
        <?php $total = 0 ?>
            <table class="table table-striped">
                <thead>
                <th>Nazwa</th>
                <th>Ilość</th>
                <th>Wartość</th>
                <th></th>
                </thead>
                <tbody>
                @php
                    $cart = collect(session('cart'));
                @endphp
                @foreach($cart->sortBy('category_id')->sortBy('pozycja') as $id => $details)
                    <?php
                    $total += $details['cena'] * $details['quantity'];
                    ?>
                    <tr {{ $details['wybor'] == 1 ? ' class=table-danger' : '' }}>
                        <td>{{ $details['nazwa'] }}
                            @if(isset($details['comments_to_item']))
                                <hr>
                                {{ $details['comments_to_item'] }}
                            @endif
                        </td>
                        <td>{{ $details['quantity'] }}{{$details['jm']}}</td>
                        <td>{{ number_format($details['cena'] * $details['quantity'],2)}} zł</td>
                        <td>
                            <form action="/remove/{{$details['id']}}" method="POST">
                                <input type="hidden" name="_method" value="DELETE">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <button type="submit" class="btn btn-danger delete-user">Usuń</button>
                            </form>
                        </td>
                    </tr>
                    <tr>
                        <form method="POST" action="/update-cart-item">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="itemId" value="{{ $id }}">

                                <td><input name = "commentsToItem" class="form-control small" placeholder="Uwagi"></td>
                                <td><input name = "newQuantity" class="form-control small"></td>
                                <td></td>
                                <td><button type="submit" class="small btn btn-sm btn-success">Zapisz</button></td>
                        </form>
                    </tr>


                @endforeach
                <?php  session()->put('total', $total); ?>
                </tbody>
            </table>
            <hr>
            @include('layouts/cart/cart_save')

    </div>
</div>
