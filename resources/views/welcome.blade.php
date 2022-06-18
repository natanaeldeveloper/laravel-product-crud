@extends('layouts.app')

@section('styles')

@endsection

@section('content')
    <h4>Dashboard</h4>
    <ul>
        <li><a href="{{ route('product.index') }}">Produtos</a></li>
    </ul>
@endsection

@section('scripts')

@endsection
