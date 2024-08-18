@extends('front.layouts.layout')

@section('content')
@php
$direction = $selectedLanguage == 'ar' ? 'rtl' : 'ltr';
@endphp
<section class="breadcrumb-blog set-bg" data-setbg="{{ asset('front/img/breadcrumb-bg.jpg') }}">
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
    <div class="card mb-3">
        <div class="card-header">
            {{ __('message.orders') }} #{{ $order->id }} - {{ $order->created_at->format('d M Y') }}
            <span class="badge badge-{{ $order->status === 'pending' ? 'warning' : 'success' }}">{{ ucfirst($order->status) }}</span>
        </div>
        <div class="card-body">
            <h5 class="card-title">{{ __('message.total') }}:  {{ $order->total_price }}  {{ __('message.EGP') }}</h5>
            <p class="card-text">{{ __('message.address') }}:  {{ $order->address }}</p>
            @foreach ($order->orderItems as $item)
            @php
                $translation = $item->product->translation($selectedLanguage);
            @endphp
            <h5 class="card-title">{{ $translation->title }}    :                  {{ $item->quantity }} x {{ __('message.EGP') }} {{ $item->price }} =  {{ $item->quantity * $item->price }}  {{ __('message.EGP') }}</h5>
            {{-- $translation = $item->product->translation($selectedLanguage); --}}

            @endforeach  
            <h4>{{ __('message.total') }}:   {{ $order->total_price }}  {{ __('message.EGP') }}</h4>
            <a href="{{ route('orders.index') }}" class="btn btn-secondary">{{ __('message.order') }}</a>
        </div>

    </div>
</div>
@endsection
