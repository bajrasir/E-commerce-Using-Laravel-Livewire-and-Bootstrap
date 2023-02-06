@extends('layouts.app');

@section('title', 'Thank You for Shopping')

@section('content')

    <div class="py-3 pyt-md-4">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    @if (session('message'))
                        <h5 class="alert alert-success">
                            {{ session('message') }}
                        </h5>
                    @endif
                    <div class="p-4 shadow bg-white">
                        <img src="{{ asset('admin/images/logo.png') }}" style="height: 200px" alt="">
                        <h4>Thank You For Shopping With E-shop</h4>
                        <a href="{{ url('collections') }}" class="btn btn-primary">Shop Now</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
