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
                                        <td width="20%"><input {{ $product->jm == 'kg' || $product->jm == 'l' ? ' type=number step=0.25' : 'type=number step=1' }} class="form-control" name="quantity" /></td>
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
