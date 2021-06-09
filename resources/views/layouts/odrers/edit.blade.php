@extends('layouts.app')

@section('content')
    <div class="alert-success">
        @include('layouts/flash-message')
    </div>
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
@endsection

