@extends('layouts.app')

@section('content')

<div class="login-box animated @if (count($errors) > 0) jello @else fadeInDown @endif">
    <div class="login-logo">
        <a href="/"><b>Application</b> Blog</a>
    </div>
  
    <div class="login-box-body">
        <p class="login-box-msg">Sign in to start your session</p>
        @if (count($errors) > 0)
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        {{ Form::open(['url' => URL::current(),'autocomplete'=>'off']) }}
        <div class="form-group">
            <div class="input-group">
                {{ Form::text('username', null, ['class' => 'form-control', 'placeholder' => 'Username']) }}
                <div class="input-group-addon">
                    <i class="fa fa-user fa-fw"></i>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="input-group">
            {{ Form::password('password', ['class' => 'form-control', 'placeholder' => 'Password']) }}
                <div class="input-group-addon">
                    <i class="fa fa-lock fa-fw"></i>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-8">
                <div class="checkbox">
                    <label>
                        <input type="checkbox"> Remember Me
                    </label>
                </div>
            </div>
            <div class="col-xs-4">
                <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
            </div>
        </div>
        {{ Form::close() }}
        <a href="#">I forgot my password</a><br>
        <a href="#" class="text-center">Register a new membership</a>
    </div>
</div>
@endsection
