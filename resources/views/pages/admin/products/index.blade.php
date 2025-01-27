@extends('pages.admin.layout.base')

@section('title', '| Products')

@section('content-header')
    <h1>Products List</h1>
@endsection

@section('content')
    <livewire:admin.products.index />
@endsection
