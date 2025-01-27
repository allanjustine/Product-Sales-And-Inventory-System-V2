@extends('pages.admin.layout.base')

@section('title', '| Profile')

@section('content-header')
    <h4><u>{{ Auth::user()->name }}</u></h4>
@endsection

@section('content')
    <livewire:admin.pages.profile />
@endsection
