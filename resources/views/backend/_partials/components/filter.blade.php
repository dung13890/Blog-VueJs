<div class="collapse" id="filter">
    <div class="row">
        <div class="col-sm-4">
            <div class="form-group">
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="fa fa-search"></i>
                    </span>
                    {{ Form::text('keyword', null, ['class' => 'form-control pull-right', 'placeholder' => 'Searching...']) }}
                </div>
            </div>
        </div>

        {{ $filter_fields }}

        <div class="col-sm-4">
            <div class="form-group">
                <a id="search" href="#" class="btn btn-primary"><i class="fa fa-search"></i> {{ __('repositories.search') }}</a>
                <a id="reset" href="#" class="btn btn-default"><i class="fa fa-refresh"></i> {{ __('repositories.reset') }}</a>
            </div>
        </div>
    </div>
    <hr>
</div>
