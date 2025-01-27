@extends('pages.admin.layout.base')

@section('title', '| Users Order')

@section('content-header')
    <h1>User's Order</h1>
@endsection

@section('content')
    <livewire:admin.orders.index />
@endsection
