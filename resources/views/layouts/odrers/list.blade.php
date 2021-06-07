@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <table class="table table-striped">
        <thead>
            <th>L.p</th>
            <th>Data</th>
            <th>Nazwisko zamawiającego</th>
            <th>Telefon kontaktowy</th>
            <th>Data realizacji</th>
            <th>Uwagi</th>
            <th>Kwota</th>
            <th>Operacje</th>
        </thead>
        <tbody>
        @foreach($orders as $order)
            <tr>
                <td>
                    {{$order['id']}}
                </td>
                <td>
                    {{$order['date']}}
                </td>
                <td>
                    {{$order['customer_name']}}
                </td>
                <td>
                    {{$order['customer_tel']}}
                </td>
                <td>
                    {{$order['delivery']}} {{strftime('%a', strtotime(iconv("ISO-8859-2","UTF-8",ucfirst(strftime($order['delivery'])))))}}
                </td>
                <td>
                    {{$order['comments']}}
                </td>
                <td>
                    {{$order['total']}}
                </td>
                <td>
                    <a href="/pdf-kitchen/{{$order['id']}}" class="btn-sm btn-outline-primary">Wydruk na kuchnie</a>
                    <button class="btn-sm btn-outline-primary">Wydruk dla Klienta</button>
                </td>
                <td>
                    <div class="d-block">
                        <form action="/order/{{$order['id']}}" method="POST">
                            <a href="/edit-customer/{{$order['id']}}" class="btn-sm btn-success">Edycja danych Klienta</a>
                            <a href="/order/{{$order['id']}}/edit" class="btn-sm btn-success">Edycja zamówienia</a>
                            <input type="hidden" name="_method" value="DELETE">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <button type="submit" class="btn-sm btn-group-sm btn-danger delete-user">Usuń</button>
                            <a href="/update-status/{{$order['id']}}" class="btn-sm btn-group-sm btn-primary">Zrealizowane</a>
                        </form>
                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
@endsection

