@extends('layouts.app')

@section('content')
        <div class="alert-success">
            @include('layouts/flash-message')
        </div>

        <div class="card">
            <div class="card-header">
                Dane Klienta
            </div>
            <div class="card-body">
                <?php $customer = session()->get('customer'); ?>
                @if(session('customer'))
                {{ $customer['customer_name'] }}<br>
                    {{ $customer['customer_tel'] }}<br>
                {{ $customer['customer_email'] }}<br>
                    @endif

            </div>
        </div>

        <!-- Content Row-->
        <div class="row justify-content-center d-grid">
            <div class="col overflow-scroll" style="height: 500px">
                <div id="accordion">
                    @foreach($categories as $category )
                        <?php $loop_index = $loop->index?>
                        <div class="card">
                            <div class="card-header" id="headingOne_{{$loop->index}}">
                                <h5 class="mb-0">
                                    <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne_{{$loop->index}}" aria-expanded="false" aria-controls="collapseOne_{{$loop->index}}">
                                        {{$category->nazwa}}
                                    </button>
                                </h5>
                            </div>
                            @foreach($category->products as $product)
                                <div id="collapseOne_{{$loop_index}}" class="collapse" aria-labelledby="headingOne_{{$loop->index}}" data-parent="#accordion">
                                    <div class="card-body">
                                        <table class="table">
                                            <thead></thead>
                                            <tbody>
                                            <form action="/add-to-cart" method="POST">
                                                <input value="{{$product->id}}" hidden name="product_id" />

                                                <tr>
                                                    <td width="60%">{{ $product->nazwa }}</td>
                                                    <td width="20%"><input type="number" class="form-control" name="quantity" /></td>
                                                    <td width="20%"><button class="btn btn-outline-success btn-block btn-sm" type="submit">Dodaj</button></td>
                                                </tr>

                                            @csrf <!-- {{ csrf_field() }} -->
                                            </form>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="col">
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
                                        <td>{{ $details['cena'] }} zł</td>
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
                            <form action="/save-order" method="POST">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <label for="suma">Suma</label>
                                <input type="text" name="total" class="form-control" value="{{ $total }}">
                                <hr>
                                <button type="submit" class="btn btn-lg btn-success">Zapisz zamówienie</button>
                            </form>

                    </div>
                </div>
            </div>
{{--        <div class="row">--}}
{{--            <div class="col-md-6 mb-5">--}}
{{--                <div class="card h-200">--}}
{{--                    <div class="card-body">--}}
{{--                        <table class="table">--}}
{{--                            <thead>--}}
{{--                            <th>Nazwa</th>--}}
{{--                            <th>ilość</th>--}}
{{--                            <th>cena/szt.</th>--}}
{{--                            <th></th>--}}
{{--                            </thead>--}}
{{--                            <tbody>--}}
{{--                            <tr class="table-primary"><td colspan="3"><strong>Patery</strong></td></tr>--}}
{{--                            @foreach($plates as $plate )--}}

{{--                                <form action="/add-to-cart" method="POST">--}}
{{--                                @csrf <!-- {{ csrf_field() }} -->--}}
{{--                                    <input hidden name="plate" value="1" />--}}
{{--                                    <input value="{{$plate->id}}" hidden name="plate_id" />--}}
{{--                                    <tr>--}}
{{--                                        <td>{{ $plate->nazwa }} </td>--}}
{{--                                        <td><input type="number" class="form-control" name="quantity" /></td>--}}
{{--                                        <td><button class="btn btn-outline-success btn-block btn-sm" type="submit">Dodaj</button></td>--}}
{{--                                    </tr>--}}
{{--                                </form>--}}
{{--                            @endforeach--}}
{{--                            @foreach($categories as $category )--}}
{{--                                <tr class="table-primary"><td colspan="3"><strong>{{$category->nazwa}}</strong></td></tr>--}}
{{--                                @foreach($category->products as $product)--}}
{{--                                    <form action="/add-to-cart" method="POST">--}}
{{--                                        <input value="{{$product->id}}" hidden name="product_id" />--}}
{{--                                    @csrf <!-- {{ csrf_field() }} -->--}}
{{--                                        <tr>--}}
{{--                                            <td>{{ $product->nazwa }}</td>--}}
{{--                                            <td><input type="number" class="form-control" name="quantity" /></td>--}}
{{--                                            <td><button class="btn btn-outline-success btn-block btn-sm" type="submit">Dodaj</button></td>--}}
{{--                                        </tr>--}}
{{--                                    </form>--}}
{{--                                @endforeach--}}
{{--                            @endforeach--}}
{{--                            </tbody>--}}
{{--                        </table>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="col-md-6 mb-5">--}}
{{--                <div class="card h-100">--}}
{{--                    <div class="card-body">--}}
{{--                        <?php $total = 0 ?>--}}
{{--                        @if(session('cart') && session('cart.edit') != 1)--}}
{{--                            <table class="table table-striped">--}}
{{--                                <thead>--}}
{{--                                <th>Nazwa</th>--}}
{{--                                <th>ilość</th>--}}
{{--                                <th>cena/szt.</th>--}}
{{--                                <th></th>--}}
{{--                                </thead>--}}
{{--                                <tbody>--}}
{{--                                @foreach(session('cart') as $id => $details)--}}
{{--                                    <?php--}}
{{--                                    $total += $details['cena'] * $details['quantity'];--}}
{{--                                    ?>--}}

{{--                                    <tr>--}}
{{--                                        <td>{{ $details['nazwa'] }}</td>--}}
{{--                                        <td>{{ $details['quantity'] }}</td>--}}
{{--                                        <td>{{ $details['cena'] }} zł</td>--}}
{{--                                        <td>--}}
{{--                                            <form action="/remove/{{$details['id']}}" method="POST">--}}
{{--                                                <input type="hidden" name="_method" value="DELETE">--}}
{{--                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">--}}
{{--                                                <button type="submit" class="btn btn-danger delete-user">Usuń</button>--}}
{{--                                            </form>--}}
{{--                                        </td>--}}
{{--                                    </tr>--}}

{{--                                @endforeach--}}
{{--                                <?php  session()->put('total', $total); ?>--}}
{{--                                </tbody>--}}
{{--                            </table>--}}
{{--                        @endif--}}
{{--                        <hr>--}}
{{--                            <form action="/save-order" method="POST">--}}
{{--                                <input type="hidden" name="_token" value="{{ csrf_token() }}">--}}
{{--                                <label for="suma">Suma</label>--}}
{{--                                <input type="text" name="total" class="form-control" value="{{ $total }}">--}}
{{--                                <hr>--}}
{{--                                <button type="submit" class="btn btn-lg btn-success">Zapisz zamówienie</button>--}}
{{--                            </form>--}}

{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}

    </div>

    <script>
        $('tr').on('click', function (e) {
            e.preventDefault();
            var elem = $(this).next('form')
            elem.toggle('slow');
        });
    </script>
@endsection
