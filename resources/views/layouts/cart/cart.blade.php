<div class="card h-100">
    <div class="card-body">
        <?php $total = 0 ?>
        @if(session('cart') && session('cart.edit') != 1)
            <table class="table table-striped">
                <thead>
                <th>Nazwa</th>
                <th>ilość</th>
                <th>cena/szt.</th>
                <th></th>
                </thead>
                <tbody>
                @foreach(session('cart') as $id => $details)
                    <?php
                    $total += $details['cena'] * $details['quantity'];
                    ?>
                    <tr>
                        <td>{{ $details['nazwa'] }}</td>
                        <td>{{ $details['quantity'] }}</td>
                        <td>{{ $details['cena'] * $details['quantity']}} zł</td>
                        <td>
                            <form action="/remove/{{$details['id']}}" method="POST">
                                <input type="hidden" name="_method" value="DELETE">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <button type="submit" class="btn btn-danger delete-user">Usuń</button>
                            </form>
                        </td>
                    </tr>

                @endforeach
                <?php  session()->put('total', $total); ?>
                </tbody>
            </table>
            <hr>
            <label for="suma">Suma</label>
        @endif
        <form action="/order/{{$order->id}}" method="POST">
        @csrf <!-- {{ csrf_field() }} -->
            <input type="hidden" name="_method" value="PUT">
            <input type="text" class="form-control" name="total" value="{{ $total }}">
            <br />
            <button type="submit" class="btn btn-lg btn-success">Aktualizuj zamówienie</button>
        </form>

    </div>
</div>
