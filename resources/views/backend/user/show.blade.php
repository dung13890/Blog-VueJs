@extends('layouts.crud.show')

@push('show-content')
<div class="col-sm-4">
    @component('backend._partials.components.box', ['box_title' => __('repositories.show')])
        @slot('box_fields')
            {{ HTML::image($item->image
                ? route('image', $item->image_thumbnail)
                : asset('assets/img/backend/avatar.png'), 
                '', ['class' => 'profile-user-img img-responsive img-circle']) }}
                <h3 class="profile-username text-center">{{ $item->name }}</h3>
                <p class="text-center">{!! $item->roles->map(function ($item) {
                    return "<span class='label label-primary'>{$item->name}</span>";
                })->implode(' ') !!}</p>

                <ul class="nav nav-stacked nav-pills">
                    @include('backend.user._field', ['class' => 'fa-check-square-o', 'field' => $item->name])
                    @include('backend.user._field', ['class' => 'fa-user', 'field' => $item->username])
                    @include('backend.user._field', ['class' => 'fa-envelope-o', 'field' => $item->email])
                    <li>
                        <a href="javascript:void(0)">
                            <i class="fa @if (!$item->locked) fa-unlock @else fa-lock @endif  text-light-blue"></i>
                            @if (!$item->locked) <span class="label label-primary">Active</span> @else <span class="label label-danger">Locked</span> @endif
                        </a>
                    </li>
               </ul>
        @endslot
    @endcomponent
</div>
<div class="col-sm-8">
    <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
            <li class="active"><a href="#actions" data-toggle="tab">{{ __('repositories.info') }}</a></li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane active" id="actions">
                <div class="row">
                </div>
            </div>
        </div>
    </div>
</div>
@endpush
