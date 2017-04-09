@extends('layouts.backend')

@section('title', isset($heading) ? $heading : __('repositories.show'))

@section('page-content')
<section class="content-header">
    <h1>{{ $heading or __('repositories.show') }}</h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('backend.dashboard') }}"><i class="fa fa-dashboard"></i> {{ __('repositories.dashboard') }}</a></li>
        @if (Route::has("backend.{$resource}.index"))
        <li><a href="{{ route("backend.{$resource}.index") }}">{{ $resource }}</a></li>
        @endif
        <li class="active">{{ $heading or __('repositories.show') }}</li>
    </ol>
</section>
<div class="content">
    <div class="row">
        @stack('show-content')
    </div>
</div>
@endsection
