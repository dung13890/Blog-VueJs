<div class="box box-primary @if (isset($box_class)) {{ $box_class }} @endif">
    <div class="box-header with-border">
        <h3 class="box-title">{{ $box_title }}</h3>
        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
        </div>
    </div>
    <div class="box-body @if (isset($box_body_class)) {{ $box_body_class }} @endif">
        {{ $box_fields }}
    </div>
</div>
