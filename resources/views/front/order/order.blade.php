@extends('front.layouts.layout')
@section('content')

@php
$direction = $selectedLanguage == 'ar' ? 'rtl' : 'ltr';
@endphp

    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-blog set-bg " data-setbg="{{ asset('front/img/breadcrumb-bg.jpg') }}">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2>{{ __('message.your_order') }}</h2>
                </div>
            </div>
        </div>
    </section>
    <br>
    <div class="container {{ $direction }}">
        <h1>{{ __('message.your_order') }}</h1>
        @if ($orders->isEmpty())
            <p>You have no orders.</p>
        @else
            @foreach ($orders as $order)
                <div class="card mb-3">
                    <div class="card-header">
                        {{ __('message.orders') }} #{{ $order->id }} - {{ $order->created_at->format('d M Y') }}
                        <span class="badge badge-{{ $order->status === 'pending' ? 'warning' : 'success' }}">{{ ucfirst($order->status) }}</span>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">{{ __('message.total') }}: {{ $order->total_price }} {{ __('message.EGP') }}</h5>
                        <p class="card-text">{{ __('message.address') }}: {{ $order->address }}</p>
                        <a href="{{ route('orders.show', $order->id) }}" class="btn btn-secondary">{{ __('message.view_order') }}</a>
                    </div>
                </div>
            @endforeach
        @endif
    </div>

@endsection