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
                            <form action="/add-to-cart" method="POST">
                                <input value="{{$product->id}}" hidden name="product_id" />
                            @csrf <!-- {{ csrf_field() }} -->
                                <table class="table-sm">
                                    <tr>
                                        <td width="60%">{{ $product->nazwa }}</td>
                                        <td width="20%"><input type="number" class="form-control" name="quantity" /></td>
                                        <td width="20%"><button class="btn btn-outline-success btn-block" type="submit">Dodaj</button></td>
                                    </tr>
                                </table>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        @endforeach
    </div>
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
    {{--                                <tr class="table-primary"><td colspan="3"><button id="tr1">{{$category->nazwa}}</button></td></tr>--}}
    {{--                                @foreach($category->products as $product)--}}
    {{--                                    <form id="form1" action="/add-to-cart" method="POST">--}}
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
