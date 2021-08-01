@extends('layouts.app')

@section('content')
        <div class="alert-success">
            @include('layouts/flash-message')
        </div>

        <div class="card">
            <div class="card-header">
                Dane Klienta
                {{ session('edit') }}
            </div>
            <div class="card-body">
                <?php $customer = session()->get('customer'); ?>
                @if(session('customer'))
                {{ $customer['customer_name'] }}<br>
                    {{ $customer['customer_tel'] }}<br>
                    @endif

            </div>
        </div>

        <!-- Content Row-->
        <div class="row justify-content-center d-grid">
            <div class="col overflow-scroll" style="height: 500px">
                @include('layouts/products/plates')
                @include('layouts/products/products')
            </div>
            <div class="col">
                @if(session('cart'))
                    @include('layouts/cart/cart')
                @else
                    <p>Karta zamówienia jest pusta. Należy wybrać dodać produkt</p>
                @endif
            </div>
        </div>

{{--    </div>--}}

    <script>
        $('tr').on('click', function (e) {
            e.preventDefault();
            var elem = $(this).next('form')
            elem.toggle('slow');
        });
    </script>
@endsection
