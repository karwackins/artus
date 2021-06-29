@if(session('edit') == 1)
    <form action="/order/{{$order->id}}" method="POST">
            @csrf <!-- {{ csrf_field() }} -->
                <input type="hidden" name="_method" value="PUT">
                <label for="suma">Suma:</label>
                <input type="text" class="form-control" name="total" value="{{ number_format($total, 2) }}">
                <br />
                <button type="submit" class="btn btn-lg btn-success">Aktualizuj zamówienie</button>
     </form>
    <form action="/cancel-order" method="POST">
    @csrf <!-- {{ csrf_field() }} -->
        <button type="submit" class="btn btn-lg btn-danger">Anuluj</button>
    </form>
@else
    <form action="/save-order" method="POST">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <label for="suma">Suma</label>
        <input type="text" name="total" class="form-control" value="{{ number_format($total, 2) }}">
        <hr>
        <button type="submit" class="btn btn-lg btn-success">Zapisz zamówienie</button>
    </form>
    <form action="/cancel-order" method="POST">
    @csrf <!-- {{ csrf_field() }} -->
        <button type="submit" class="btn btn-lg btn-danger">Anuluj</button>
    </form>
@endif
