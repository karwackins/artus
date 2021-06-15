@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <table class="table table-striped">
        <thead>
            <th width="5%">L.p</th>
            <th width="10%">Data</th>
            <th width="10%">Nazwisko zamawiającego</th>
            <th width="10%">Telefon kontaktowy</th>
            <th width="10%">Data realizacji</th>
            <th width="20%">Uwagi</th>
            <th width="5%">Kwota</th>
            <th width="30%" colspan="2">Operacje</th>
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
                <td width="20%">
                    {{$order['comments']}}
                </td>
                <td>
                    {{$order['total']. ' zł' }}
                </td>
                <td>
                    <div class="d-block">
                        @if($order['status'] == 0)
                            <a href="/pdf-kitchen/{{$order['id']}}" class="btn-lg btn-primary"><i class="fas fa-fire"></i></a>
                            <a href="/pdf-customer/{{$order['id']}}" class="btn-lg btn-primary"><i class="fas fa-print"></i></a>
                        @else
                        <form action="/order/{{$order['id']}}" method="POST">
                            <a href="/pdf-kitchen/{{$order['id']}}" class="btn-lg btn-primary"><i class="fas fa-fire"></i></a>
                            <a href="/pdf-customer/{{$order['id']}}" class="btn-lg btn-primary"><i class="fas fa-print"></i></a>
                            <a href="/edit-customer/{{$order['id']}}" class="btn-lg btn-success"><i class="fas fa-user-edit"></i></a>
                            <a href="/order/{{$order['id']}}/edit" class="btn-lg btn-success"><i class="fas fa-edit"></i></a>
                            <input type="hidden" name="_method" value="DELETE">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <button type="submit" class="btn-lg btn-group-sm btn-danger delete-user"><i class="fas fa-trash-alt"></i></button>
                            <a href="/update-status/{{$order['id']}}" class="btn-lg btn-group-sm btn-primary"><i class="fas fa-check"></i></a>
                        </form>
                        @endif
                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
@endsection

