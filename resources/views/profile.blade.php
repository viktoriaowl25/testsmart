@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="b-content">
                <h1 class="b-content__title mb-3">Profile</h1>

                <div class="b-content__body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    Hello, {{ Auth::user()->name }}! You are logged in.

                    <div class="mt-4">
                        <div class="row mb-2">
                            <div class="col-2 font-weight-bold">Name</div>
                            <div class="col-10">
                                {{ $user->name }}
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-2 font-weight-bold">Email</div>
                            <div class="col-10">
                                {{ $user->email }}
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-2 font-weight-bold">Api Token</div>
                            <div class="col-10">
                                {{ $user->api_token }}
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
