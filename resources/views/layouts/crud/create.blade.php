@extends('layouts.backend')

@section('title', isset($heading) ? $heading : __('repositories.create'))

@section('page-content')
<section class="content-header">
    <h1>{{ $heading or __('repositories.create') }}</h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('backend.dashboard') }}"><i class="fa fa-dashboard"></i> {{ __('repositories.dashboard') }}</a></li>
        @if (Route::has("backend.{$resource}.index"))
        <li><a href="{{ route("backend.{$resource}.index") }}">{{ __('repositories.' . $resource) }}</a></li>
        @endif
        <li class="active">{{ $heading or __('repositories.create') }}</li>
    </ol>
</section>
<div class="content">
    <div class="row">
        {{ Form::open(['url' => route("backend.{$resource}.store"), 'role'  => 'form', 'files' => true, 'autocomplete'=>'off']) }}
            @include("backend.{$resource}._form")
        {{ Form::close() }}
    </div>
</div>
@endsection
