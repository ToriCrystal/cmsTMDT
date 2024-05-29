@extends('admin.layouts.master')

@section('content')
    <div class="page-body">
        <div class="container-xl">
            <div class="row justify-content-center">
                <div class="col-12 col-md-6">
                    <x-form :action="route('admin.profile.update')" type="put" enctype="multipart/form-data" :validate="true">
                    <div class="card">
                        <div class="card-body">
                            <!-- fullname -->
                            <div class="mb-3">
                                <label class="control-label">@lang('fullname'):</label>
                                <x-input name="fullname" :value="$auth->fullname" :required="true" placeholder="{{ __('fullname') }}"/>
                            </div>
                            <!-- phone -->
                            <div class="mb-3">
                                <label class="control-label">@lang('phone'):</label>
                                <x-input-phone name="phone" :value="$auth->phone" :required="true" />
                            </div>
                            <!-- address -->
                            <div class="mb-3">
                                <label class="control-label">@lang('address'):</label>
                                <x-input name="address" :value="$auth->address" placeholder="{{ __('address') }}"/>
                            </div>
                            <div class="mb-3">
                                <label class="control-label">@lang('bankname'):</label>
                                <x-input name="bankname" :value="$auth->bankname" :required="true" placeholder="{{ __('bankname') }}"/>
                            </div>
                            <div class="mb-3">
                                <label class="control-label">@lang('accountnumber'):</label>
                                <x-input name="accountnumber" :value="$auth->accountnumber" :required="true" placeholder="{{ __('accountnumber') }}"/>
                            </div>
                            <div class="mb-3">
                                <label class="control-label">@lang('qr'):</label>
                                <div class="card-body p-2">
                                    <x-input-image-ckfinder name="qr" showImage="qr" :value="$auth->qr" />
                                </div>
                            </div>
                        </div>
                        <div class="card-footer bg-transparent mt-auto">
                            <div class="btn-list justify-content-center">
                                <x-button.submit :title="__('update')" />
                            </div>
                        </div>
                    </div>
                    </x-form>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('libs-js')
<script src="{{ asset('public/libs/ckeditor/ckeditor.js') }}"></script>
<script src="{{ asset('public/libs/ckeditor/adapters/jquery.js') }}"></script>
@include('ckfinder::setup')
@endpush
@push('custom-js')

@endpush
