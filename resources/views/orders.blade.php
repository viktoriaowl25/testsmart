@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="b-content">
                <h1 class="b-content__title mb-3">Order List</h1>

                <div class="b-content__body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    Hello, {{ Auth::user()->name }}! You are logged in.

                    <orders-component :orders="{!! e(json_encode($orders, true)) !!}" :statuses="{!! e(json_encode($statuses, true)) !!}" :user="{!! e(json_encode(Auth::user())) !!}"></orders-component>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
