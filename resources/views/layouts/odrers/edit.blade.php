@extends('layouts.app')

@section('content')
    <div class="row justify-content-center d-grid">
        <div class="row">
            <div class="col-md-6 mb-5">
                <div class="card h-200">
                    <div class="card-body">
                        <table class="table">
                            <thead>
                            <th>Nazwa</th>
                            <th>ilość</th>
                            <th>cena/szt.</th>
                            <th></th>
                            </thead>
                            <tbody>
                            <tr class="table-primary"><td colspan="3"><strong>Patery</strong></td></tr>
                            @foreach($plates as $plate )

                                <form action="/add-to-cart" method="POST">
                                @csrf <!-- {{ csrf_field() }} -->
                                    <input hidden name="plate" value="1" />
                                    <input value="{{$plate->id}}" hidden name="plate_id" />
                                    <tr>
                                        <td>{{ $plate->nazwa }} </td>
                                        <td><input type="number" class="form-control" name="quantity" /></td>
                                        <td><button class="btn btn-outline-success btn-block btn-sm" type="submit">Dodaj</button></td>
                                    </tr>
                                </form>
                            @endforeach
                            @foreach($categories as $category )
                                <tr class="table-primary"><td colspan="3"><strong>{{$category->nazwa}}</strong></td></tr>
                                @foreach($category->products as $product)
                                    <form action="/add-to-cart" method="POST">
                                        <input value="{{$product->id}}" hidden name="product_id" />
                                    @csrf <!-- {{ csrf_field() }} -->
                                        <tr>
                                            <td>{{ $product->nazwa }}</td>
                                            <td><input type="number" class="form-control" name="quantity" /></td>
                                            <td><button class="btn btn-outline-success btn-block btn-sm" type="submit">Dodaj</button></td>
                                        </tr>
                                    </form>
                                @endforeach
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-5">
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
                            <form action="/order/{{$order->id}}" method="POST">
                            @csrf <!-- {{ csrf_field() }} -->
                                <input type="hidden" name="_method" value="PUT">
                                <input type="text" class="form-control" name="total" value="{{ $total }}">
                                <br />
                                <button type="submit" class="btn btn-lg btn-success">Aktualizuj zamówienie</button>
                            </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

