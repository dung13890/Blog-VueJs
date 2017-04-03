<div class="col-sm-9">
    @component('backend._partials.components.box', ['box_title' => __('repositories.form')])
        @slot('box_fields')
        @component('backend._partials.components.alert')
        @endcomponent
        <div class="form-group">
            <div class="row">
                <div class="col-md-6">
                    {{ Form::label('name', 'Name', ['class' => 'control-label']) }}
                    {{ Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'required: name']) }}
                </div>
                <div class="col-md-6">
                    {{ Form::label('username', 'Username', ['class' => 'control-label']) }}
                    {{ Form::text('username', null, ['class' => 'form-control', 'placeholder' => 'required: username']) }}
                </div>
            </div>
        </div>

        <div class="form-group">
            {{ Form::label('email', 'Email', ['class' => 'control-label']) }}
            {{ Form::email('email', null, ['class' => 'form-control', 'placeholder' => 'required: email@domain.com']) }}
        </div>

        <div class="form-group">
            <div class="row">
                <div class="col-sm-6">
                    {{ Form::label('password', 'Password', ['class'=>'control-label']) }}
                    {{ Form::password('password', ['class' => 'form-control', 'placeholder' => 'required: your password']) }}
                </div>
                <div class="col-sm-6">
                    {{ Form::label('password_confirmation', 'Confirm Password', ['class'=>'control-label']) }}
                    {{ Form::password('password_confirmation', ['class' => 'form-control', 'placeholder' => 'required: confirm your password']) }}
                </div>
            </div>
        </div>

        <div class="form-group">
            <div class="checkbox">
                <label>
                    {{ Form::checkbox('locked', true, old('locked'), ['data-toggle'=>'toggle', 'data-size' => 'small']) }} <b>Locked</b>
                </label>
            </div>
        </div>
        @component('backend._partials.components.submit')
        @endcomponent
        @endslot
    @endcomponent
</div>
<div class="col-sm-3">
    @include('backend.user._role')
    @include('backend._partials.form.image', ['image_name' => 'image'])
</div>
