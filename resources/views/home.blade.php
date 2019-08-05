@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="b-content">
                <h1 class="b-content__title mb-3">Product List</h1>

                <div class="b-content__body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    Hello, {{ Auth::user()->name }}! You are logged in.

                    <products-component :products="{!! e(json_encode($products, true)) !!}" :user="{!! e(json_encode(Auth::user())) !!}"></products-component>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
