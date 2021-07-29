@if(session('edit') == 1)
    <form action="/order/{{$order->id}}" method="POST">
            @csrf <!-- {{ csrf_field() }} -->
                <input type="hidden" name="_method" value="PUT">
                <label for="suma">Suma:</label>
                <input type="text" class="form-control" name="total" value="{{ number_format($total, 2) }}">
                <br />
                <div class="mt-2">
                    <button type="submit" class="btn btn-lg btn-success d-inline">Aktualizuj zamówienie</button>
                    <a href="/cancel-order" class="btn btn-lg btn-danger d-inline">Anuluj</a>
                </div>
     </form>
@else
    <form action="/save-order" method="POST">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <label for="suma">Suma</label>
        <input type="text" name="total" class="form-control" value="{{ number_format($total, 2) }}">
        <hr>
        <div class="mt-2">
            <button type="submit" class="btn btn-lg btn-success d-inline">Zapisz zamówienie</button>
            <a href="/cancel-order" class="btn btn-lg btn-danger d-inline">Anuluj</a>
        </div>
    </form>
@endif
