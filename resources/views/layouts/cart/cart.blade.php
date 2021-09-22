<div id="accordion">
        <?php $total = 0 ?>
                @php
                    $cart = collect(session('cart'));
                @endphp
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        Produkt
                    </div>
                    <div class="col-md-2">
                        Ilość
                    </div>
                    <div class="col-md-2">
                        Cena
                    </div>
                    <div class="col-md-2 text-right">

                    </div>
                </div>

            </div>
                @foreach($cart->sortBy('category_id')->sortBy('pozycja') as $id => $details)
                    <?php
                    $total += $details['cena'] * $details['quantity'];
                    ?>
                    <div class="card">
                        <div {{ $details['wybor'] == 1 ? ' class=card-header text-white bg-danger' : 'class=card-header' }}>
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-6">
                                        {{ $details['nazwa'] }}
                                    </div>
                                    <div class="col-md-2">
                                        {{ $details['quantity'] }}{{$details['jm']}}
                                    </div>
                                    <div class="col-md-2">
                                        {{ number_format($details['cena'] * $details['quantity'],2)}} zł
                                    </div>
                                    <div class="col-md-2 text-right">
                                        <form action="/remove/{{$details['id']}}" method="POST">
                                            <input type="hidden" name="_method" value="DELETE">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <input type="hidden" name="_method" value="DELETE">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <button type="submit" class="btn btn-danger"><i class="fas fa-trash-alt"></i></button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="/update-cart-item">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" name="itemId" value="{{ $id }}">
                               <div class="container">
                                   <div class="row">
                                       <div class="col-sm-4">
                                           <input name = "commentsToItem" class="form-control small" placeholder="Uwagi">
                                       </div>
                                       <div class="col-sm-4">
                                           <input name = "newQuantity" class="form-control small">
                                       </div>
                                       <div class="col-sm-4 text-right">
                                           <button type="submit" class="btn btn-success"><i class="far fa-check-square"></i></button>
                                       </div>
                                   </div>
                               </div>
                            </form>
                        </div>

{{--                            @if(isset($details['comments_to_item']))--}}
{{--                                <hr>--}}
{{--                                {{ $details['comments_to_item'] }}--}}
{{--                            @endif--}}
                        </div>
{{--                    <tr {{ $details['wybor'] == 1 ? ' class=table-danger' : '' }}>--}}
{{--                        <td>{{ $details['nazwa'] }}--}}
{{--                            @if(isset($details['comments_to_item']))--}}
{{--                                <hr>--}}
{{--                                {{ $details['comments_to_item'] }}--}}
{{--                            @endif--}}
{{--                        </td>--}}
{{--                        <td>{{ $details['quantity'] }}{{$details['jm']}}</td>--}}
{{--                        <td>{{ number_format($details['cena'] * $details['quantity'],2)}} zł</td>--}}
{{--                        <td>--}}
{{--                            <form action="/remove/{{$details['id']}}" method="POST">--}}
{{--                                <input type="hidden" name="_method" value="DELETE">--}}
{{--                                <input type="hidden" name="_token" value="{{ csrf_token() }}">--}}
{{--                                <button type="submit" class="btn btn-danger delete-user">Usuń</button>--}}
{{--                            </form>--}}
{{--                        </td>--}}
{{--                    </tr>--}}
{{--                    <tr>--}}
{{--                        <form method="POST" action="/update-cart-item">--}}
{{--                            <input type="hidden" name="_token" value="{{ csrf_token() }}">--}}
{{--                            <input type="hidden" name="itemId" value="{{ $id }}">--}}

{{--                                <td><input name = "commentsToItem" class="form-control small" placeholder="Uwagi"></td>--}}
{{--                                <td><input name = "newQuantity" class="form-control small"></td>--}}
{{--                                <td></td>--}}
{{--                                <td><button type="submit" class="small btn btn-sm btn-success">Zapisz</button></td>--}}
{{--                        </form>--}}
{{--                    </tr>--}}


                @endforeach
                <?php  session()->put('total', $total); ?>
{{--                </tbody>--}}
{{--            </table>--}}
            <hr>
            @include('layouts/cart/cart_save')

</div>
