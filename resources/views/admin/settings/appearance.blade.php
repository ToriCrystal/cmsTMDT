@extends('admin.layouts.master')

@push('libs-css')

@endpush
@push('custom-css')

@endpush
@section('content')
<div class="page-body">
    <div class="container-xl">
        <x-form :action="route('admin.setting.updateAppearance')" type="put" :validate="true">
            <div class="row justify-content-center">
                <div class="col-12 col-md-9">
                    @include('admin.settings.forms.edit-notification-left')
                </div>
                @include('admin.settings.forms.edit-notification-right')
            </div>
        </x-form>
    </div>
</div>
@endsection

@push('libs-js')

@endpush

@push('custom-js')

@endpush
