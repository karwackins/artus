@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="table-responsive-md"></div>
    <table class="table table-striped table-bordered" style="font-size: small">
        <thead>
            <th width="5%">L.p</th>
            <th width="15%">Data</th>
            <th width="10%">Klient</th>
            <th width="10%">Telefon</th>
            <th width="15%">Data realizacji</th>
            <th width="17%">Uwagi</th>
            <th width="8%">Kwota</th>
            <th width="20%" colspan="2">Operacje</th>
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
                    {{$order['customer_name']}} <br>
                    {{$order['customer_address']}}
                </td>
                <td>
                    {{$order['customer_tel']}}
                </td>
                <td>
                    {{$order['delivery']}} ({{strftime('%A', strtotime(iconv("ISO-8859-2","UTF-8",ucfirst(strftime($order['delivery'])))))}})
                </td>
                <td width="20%">
                    {{$order['comments']}}
                    <hr>
                    {{$order['order_comments']}}
                </td>
                <td>
                    {{$order['total']. ' zł' }}
                </td>
                <td>
                    <div class="d-block">
                        @if($order['status'] == 0)
                            <a href="/pdf-kitchen/{{$order['id']}}" class="btn btn-primary m-1"><i class="fas fa-fire"></i></a>
                            <a href="/pdf-customer/{{$order['id']}}" class="btn btn-primary m-1"><i class="fas fa-print"></i></a>
                        @else
                        <form action="/order/{{$order['id']}}" method="POST">
                            <div class="container">
                                <div class="row">
                                    <a href="/pdf-kitchen/{{$order['id']}}" class="btn btn-primary m-1"><i class="fas fa-fire"></i></a>
                                    <a href="/pdf-customer/{{$order['id']}}" class="btn btn-primary m-1"><i class="fas fa-print"></i></a>
                                    <a href="/update-status/{{$order['id']}}" class="btn btn-primary m-1"><i class="fas fa-check"></i></a>
{{--                                </div>--}}
{{--                                <div class="row">--}}
                                    <a href="/edit-customer/{{$order['id']}}" class="btn btn-success m-1"><i class="fas fa-user-edit"></i></a>
                                    <a href="/order/{{$order['id']}}/edit" class="btn btn-success m-1"><i class="fas fa-edit"></i></a>
                                    <input type="hidden" name="_method" value="DELETE">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <button type="submit" class="btn btn-group-sm btn-danger delete-user m-0"><i class="fas fa-trash-alt"></i></button>
{{--                                </div>--}}
                            </div>
                        </form>
                        @endif
                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
</div>
@endsection

