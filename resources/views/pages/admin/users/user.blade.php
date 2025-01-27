@extends('pages.admin.layout.base')

@section('title', '| User')

@section('content-header')
    <h1>User's List</h1>
@endsection

@section('content')
    <livewire:admin.users.index />
@endsection
