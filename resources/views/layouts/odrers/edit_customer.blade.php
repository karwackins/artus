@extends('layouts.app')

@section('content')
    <div class="row justify-content-center d-grid">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    Dane Klienta
                </div>
                <div class="card-body">
                    <form action="/order/{{$customer['order_id']}}" method="POST">
                    @csrf <!-- {{ csrf_field() }} -->
                        <input type="hidden" name="_method" value="PUT">
                        <input type="hidden" name="customer" value="1">
                        <label for="exampleFormControlInput1" class="form-label">Imię i nazwisko</label>
                        <input type="text" class="form-control{{ $errors->has('customer_name') ? ' is-invalid' : '' }}" name="customer_name" value="{{$customer['customer_name']}}" placeholder="Nazwa Klienta">
                        @error('customer_name') {{$message}} @enderror
                        <label for="exampleFormControlInput1" class="form-label">Numer telefonu</label>
                        <input type="text" class="form-control{{ $errors->has('customer_tel') ? ' is-invalid' : '' }}" name="customer_tel" value="{{$customer['customer_tel']}}" placeholder="Numer telefonu">
                        @error('customer_tel') {{$message}} @enderror
                        <label for="exampleFormControlInput1" class="form-label">Email Klienta</label>
                        <input type="email" class="form-control{{ $errors->has('customer_email') ? ' is-invalid' : '' }}" name="customer_email" value="{{$customer['customer_email']}}" placeholder="Email Klienta">
                        @error('customer_email') {{$message}} @enderror
                        <label for="exampleFormControlInput1" class="form-label">Adres Klienta</label>
                        <input type="text" class="form-control{{ $errors->has('customer_address') ? ' is-invalid' : '' }}" name="customer_address" value="{{$customer['customer_address']}}" placeholder="Adres Klienta">
                        @error('customer_address') {{$message}} @enderror
                        <label for="exampleFormControlInput1" class="form-label">Data zamówienia</label>
                        <input type="datetime-local" class="form-control{{ $errors->has('delivery') ? ' is-invalid' : '' }}" name="delivery" value="{{date('Y-m-d\TH:i', strtotime($customer['delivery']))}}" placeholder="Data dostawy">
                        @error('delivery') {{$message}} @enderror
                        <label for="exampleFormControlInput1" class="form-label">Uwagi do zamówienia</label>
                        <textarea class="form-control m-3" name="comments" id="" cols="30" rows="5" placeholder="Uwagi">{{$customer['comments']}}</textarea>
                        <br />
                        <br />
                        @if($customer['dowoz'] == 1)
                            <input type="checkbox" name="dowoz" value="1" checked> Dowóz do Klienta
                        @else
                            <input type="checkbox" name="dowoz" value="1"> Dowóz do Klienta
                        @endif

                        <div class="mt-2">
                            <button type="submit" class="btn btn-lg btn-success d-inline">Aktualizuj dane Klienta</button>
                            <a href="/cancel-order" class="btn btn-lg btn-danger d-inline">Anuluj</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

