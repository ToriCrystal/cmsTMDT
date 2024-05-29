@extends('stores.layouts.master')

@section('content')
    <div class="page-body">
        <div class="container-xl">
            <x-form :action="route('store.topping.update')" type="put" :validate="true">

                <div class="row justify-content-center">
                    @include('stores.toppings.forms.edit-left')
                    @include('stores.toppings.forms.edit-right')
                </div>
                @include('stores.forms.actions-fixed')
            </x-form>
        </div>
    </div>
@endsection

@push('libs-js')
    @include('ckfinder::setup')
@endpush