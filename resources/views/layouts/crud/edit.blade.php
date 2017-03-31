@extends('layouts.backend')

@section('title', isset($heading) ? $heading : __('repositories.edit'))

@section('page-content')
<section class="content-header">
    <h1>{{ $heading or __('repositories.edit') }}</h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('backend.dashboard') }}"><i class="fa fa-dashboard"></i> {{ __('repositories.dashboard') }}</a></li>
        @if (Route::has("backend.{$resource}.index"))
        <li><a href="{{ route("backend.{$resource}.index") }}">{{ $resource }}</a></li>
        @endif
        <li class="active">{{ $heading or __('repositories.edit') }}</li>
    </ol>
</section>
<div class="content">
    <div class="row">
        {{ Form::model($item, [
            'url' => route("backend.{$resource}.update", $item),
            'role'  => 'form', 'files' => true,
            'autocomplete'=>'off', 'method' => 'PATCH',
        ]) }}
            @include("backend.{$resource}._form")
        {{ Form::close() }}
    </div>
</div>
@endsection
