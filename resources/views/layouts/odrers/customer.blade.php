@extends('layouts.app')

@section('content')
    <div class="row justify-content-center d-grid">
        <div class="col-8">
            <div class="card">
                <div class="card-header">
                    Dane Klienta
                </div>
                <div class="card-body">
                    <form action="/add-customer" method="POST">
                    @csrf <!-- {{ csrf_field() }} -->
                        <label for="exampleFormControlInput1" class="form-label">Imię i nazwisko</label>
                        <input type="text" class="form-control{{ $errors->has('customer_name') ? ' is-invalid' : '' }}" name="customer_name" value="{{ old('customer_name') }}" placeholder="Nazwa Klienta">
                        @error('customer_name') {{$message}} @enderror
                        <br>
                        <label for="exampleFormControlInput1" class="form-label">Numer telefonu</label>
                        <input type="text" class="form-control{{ $errors->has('customer_tel') ? ' is-invalid' : '' }}" name="customer_tel" value="{{ old('customer_tel') }}" placeholder="Numer telefonu">
                        @error('customer_tel') {{$message}} @enderror
                        <br>
                        <label for="exampleFormControlInput1" class="form-label">Adres Klienta</label>
                        <input type="text" class="form-control{{ $errors->has('customer_address') ? ' is-invalid' : '' }}" name="customer_address" value="{{ old('customer_address') }}" placeholder="Adres Klienta">
                        @error('customer_address') {{$message}} @enderror
                        <br>
                        <label for="exampleFormControlInput1" class="form-label">Data dostawy</label>
                        <input type="datetime-local" class="form-control{{ $errors->has('delivery') ? ' is-invalid' : '' }}" name="delivery" value="{{ old('delivery') }}" placeholder="Data dostawy">
                        @error('delivery') {{$message}} @enderror
                        <br>
                        <label for="exampleFormControlInput1" class="form-label">Uwagi do zamówienia</label>
                        <textarea class="form-control m-3" name="comments" id="" cols="30" rows="5" placeholder="Uwagi"></textarea>
                        <br />
                        <input type="checkbox" name="dowoz" checked value="1"> Dowóz do Klienta
                        <div class="mt-2">
                            <button type="submit" class="btn btn-lg btn-success d-inline">Dalej</button>
                            <a href="/cancel-order" class="btn btn-lg btn-danger d-inline">Anuluj</a>
                        </div>
                    </form>
                    {{--                    <form class="d-inline" action="/cancel-order" method="POST">--}}
{{--                    @csrf <!-- {{ csrf_field() }} -->--}}
{{--                        <button type="submit" class="btn btn-lg btn-danger d-inline">Anuluj</button>--}}
{{--                    </form>--}}
                </div>
            </div>
        </div>
    </div>

@endsection

