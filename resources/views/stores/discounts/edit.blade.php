@extends('stores.layouts.master')
@push('libs-css')
@endpush
@section('content')
    <div class="page-body">
        <div class="container-xl">
            <x-form :action="route('store.discount.update')" type="put" :validate="true">
                <x-input type="hidden" name="id" :value="$page->id" />
                <div class="row justify-content-center">
                    @include('stores.discounts.forms.edit-left')
                    @include('stores.discounts.forms.edit-right')
                </div>
                @include('stores.forms.actions-fixed')
            </x-form>
        </div>
    </div>
@endsection

@push('libs-js')
<script src="{{ asset('public/libs/ckeditor/ckeditor.js') }}"></script>
<script src="{{ asset('public/libs/ckeditor/adapters/jquery.js') }}"></script>
@endpush

@push('custom-js')

@endpush
