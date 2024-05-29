<div class="col-12 col-md-9">
    <div class="card">
        <div class="card-header justify-content-center">
        </div>
        <div class="row card-body">
            <!-- username -->
{{--            <div class="col-md-6 col-12">--}}
{{--                <div class="mb-3">--}}
{{--                    <label class="control-label">@lang('username'):</label>--}}
{{--                    <x-input name="username" :value="old('username')" :required="true" :placeholder="__('username')" />--}}
{{--                </div>--}}
{{--            </div>--}}
            <!-- Fullname -->
            <div class="col-md-6 col-12">
                <div class="mb-3">
                    <label class="control-label">@lang('fullname'):</label>
                    <x-input name="fullname" :value="old('fullname')" :required="true"
                        :placeholder="__('fullname')" />
                </div>
            </div>
            <!-- email -->
            <div class="col-md-6 col-12">
                <div class="mb-3">
                    <label class="control-label">@lang('email'):</label>
                    <x-input-email name="email" :value="old('email')"  />
                </div>
            </div>
            <!-- phone -->
            <div class="col-md-6 col-12">
                <div class="mb-3">
                    <label class="control-label">@lang('phone'):</label>
                    <x-input-phone name="phone" :value="old('phone')" :required="true" />
                </div>
            </div>
            <!-- gender -->
            <div class="col-md-6 col-12">
                <div class="mb-3">
                    <label class="control-label">@lang('gender'):</label>
                    <x-select name="gender" :required="true">
                        @foreach ($gender as $key => $value)
                            <x-select-option :value="$key" :title="__($value)" />
                        @endforeach
                    </x-select>
                </div>
            </div>
            <!-- new password -->
            <div class="col-md-6 col-12">
                <div class="mb-3">
                    <label class="control-label">@lang('password'):</label>
                    <x-input-password name="password" :required="true" />
                </div>
            </div>
            <!-- new password confirmation-->
            <div class="col-md-6 col-12">
                <div class="mb-3">
                    <label class="control-label">@lang('passwordConfirm'):</label>
                    <x-input-password name="password_confirmation" :required="true"
                        data-parsley-equalto="input[name='password']"
                        data-parsley-equalto-message="{{ __('passwordMismatch') }}" />
                </div>
            </div>

            <!-- birthday -->
            <div class="col-md-6 col-12">
                <div class="mb-3">
                    <label class="control-label">@lang('birthday'):</label>
                    <x-input type="date" name="birthday" :required="true" />
                </div>
            </div>
            <!-- Area -->
            <div class="col-md-6 col-12">
                <div class="mb-3">
                    <label class="control-label">@lang('area'):</label>
                    <x-select name="area_id" :required="true">
                        @foreach ($areas as $area)
                            <x-select-option :value="$area->id" :title="$area->name" />
                        @endforeach
                    </x-select>
                </div>
            </div>
{{--            <!-- roles -->--}}
{{--            <div class="col-md-6 col-12">--}}
{{--                <div class="mb-3">--}}
{{--                    <label class="control-label">@lang('role'):</label>--}}
{{--                    <x-select name="roles" :required="true">--}}
{{--                        @foreach ($roles as $key => $value)--}}
{{--                            <x-select-option :value="$key" :title="__($value)" />--}}
{{--                        @endforeach--}}
{{--                    </x-select>--}}
{{--                </div>--}}
{{--            </div>--}}

        </div>
    </div>
</div>
