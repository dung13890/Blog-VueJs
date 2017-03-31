@component('backend._partials.components.box', [
    'box_class' => 'box-solid',
    'box_body_class' => 'no-padding',
    'box_title' => __('repositories.role')
])

@slot('box_fields')
<ul class="nav nav-stacked">
    @foreach($roles as $id => $name)
        <li>
            <div class="container-fluid checkbox">
                <label>
                    {{ Form::checkbox('role_ids[]', $id, (isset($item) && isset($item->roles->keyBy('id')[$id])) ? true : false) }}
                    {{ $name }}
                </label>
            </div>
        </li>
    @endforeach
</ul>
@endslot
@endcomponent

