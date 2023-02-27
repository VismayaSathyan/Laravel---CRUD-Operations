@extends('layout.app')

@section('title', 'show')

@section('products')
        <h1 class="display-4">{{ $product->name }}</h1>
        <p style="font-size: 40px">{{ $product->description }}</p>
        <p style="font-size: 40px">Rs {{ $product->price}}</p>
@endsection