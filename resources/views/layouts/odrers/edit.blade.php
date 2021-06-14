@extends('layouts.app')

@section('content')
    <div class="alert-success">
        @include('layouts/flash-message')
    </div>
    <div class="row justify-content-center d-grid">
        <div class="col overflow-scroll" style="height: 500px">
            {{session('edit')}}
        @include('layouts/products/plates')
        @include('layouts/products/products')
        </div>
        <div class="col">
        @include('layouts/cart/cart')
        </div>
    </div>
@endsection

