 <div id="accordion">
            <div class="card">
                <div class="card-header" id="headingOne">
                    <h5 class="mb-0">
                        <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                            Patery
                        </button>
                    </h5>
                </div>
                @foreach($plates as $plate)
                    <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                        <div class="card-body">
                            <form action="/add-to-cart" method="POST">
                                <input hidden name="plate" value="1" />
                                <input value="{{$plate->id}}" hidden name="plate_id" />
                            @csrf <!-- {{ csrf_field() }} -->
                                <table class="table-sm">
                                    <tr>
                                        <td width="60%">{{ $plate->nazwa }}</td>
                                        <td width="20%"><input type="number" class="form-control" name="quantity" /></td>
                                        <td width="20%"><button class="btn btn-outline-success btn-block" type="submit">Dodaj</button></td>
                                    </tr>
                                </table>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
    </div>
