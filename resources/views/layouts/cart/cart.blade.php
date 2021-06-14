<div class="card h-100">
    <div class="card-body">
        <?php $total = 0 ?>
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
            @include('layouts/cart/cart_save')

    </div>
</div>
