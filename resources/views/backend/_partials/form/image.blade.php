@push('prestyles')
{{ HTML::style('vendor/jasny-bootstrap/css/jasny-bootstrap.min.css') }}
@endpush

@component('backend._partials.components.box', [
    'box_class' => 'box-solid',
    'box_title' => __('repositories.image')
])
@slot('box_fields')
<div class="fileinput fileinput-new"  data-provides="fileinput">
    <div class="fileinput-preview thumbnail" data-trigger="fileinput">
        {{ HTML::image( (isset($item) && $item->image ) ? route('image', $item->image_medium) :  asset('assets/img/backend/no_image.jpg'), '', ['width' => '100%']) }}
    </div>
    <div>
        <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
        <div class="btn btn-default btn-file">
            <span class="fileinput-new">Select image</span>
            <span class="fileinput-exists">Change</span>
            {{ Form::file($image_name) }}
        </div>
    </div>
</div>
@endslot
@endcomponent

@push('prescripts')
{{ HTML::script('vendor/jasny-bootstrap/js/jasny-bootstrap.min.js') }}
@endpush
