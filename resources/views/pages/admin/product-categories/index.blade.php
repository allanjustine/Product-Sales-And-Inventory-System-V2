@extends('pages.admin.layout.base')

@section('title', '| Categories')

@section('content-header')
    <h1>Categories List</h1>
@endsection

@section('content')
    <livewire:admin.product-categories.index />
@endsection
