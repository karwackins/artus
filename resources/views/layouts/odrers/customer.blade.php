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
                        <input type="text" class="form-control m-3" name="customer_name" placeholder="Nazwa Klienta">
                        <label for="exampleFormControlInput1" class="form-label">Numer telefonu</label>
                        <input type="text" class="form-control m-3" name="customer_tel" placeholder="Numer telefonu">
                        <label for="exampleFormControlInput1" class="form-label">Email Klienta</label>
                        <input type="email" class="form-control m-3" name="customer_email" placeholder="Email Klienta">
                        <label for="exampleFormControlInput1" class="form-label">Data dostawy</label>
                        <input type="datetime-local" class="form-control m-3" name="delivery" placeholder="Data dostawy">
                        <label for="exampleFormControlInput1" class="form-label">Uwagi do zamówienia</label>
                        <textarea class="form-control m-3" name="comments" id="" cols="30" rows="5" placeholder="Uwagi"></textarea>
                        <br />
                        <button type="submit" class="btn btn-lg btn-success">Dalej</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

