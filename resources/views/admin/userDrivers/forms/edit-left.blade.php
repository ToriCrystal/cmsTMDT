<div class="col-12 col-md-9">
    <div class="card">
        <div class="card-header fw-bold h3">
            @lang('driver_register_information')
        </div>
        <div class="row card-body">
            {{-- id_card input --}}
            <div class="col-md-6 col-12">
                <div class="mb-3">
                    <label class="control-label">@lang('id_card'):</label>
                    <x-input name="id_card" :value="$driver->id_card ?? old('id_card')" :required="true"
                             :placeholder="__('id_card')"/>
                </div>
            </div>
            {{-- license_plate input --}}
            <div class="col-md-6 col-12">
                <div class="mb-3">
                    <label class="control-label">@lang('license_plate'):</label>
                    <x-input name="license_plate" :value="$driver->license_plate ?? old('license_plate')"
                             :placeholder="__('license_plate')"/>
                </div>
            </div>
            {{-- vehicle_company input --}}
            <div class="col-md-6 col-12">
                <div class="mb-3">
                    <label class="control-label">@lang('vehicle_company'):</label>
                    <x-input name="vehicle_company" :value="$driver->vehicle_company ?? old('vehicle_company')"
                             :placeholder="__('vehicle_company')"/>
                </div>
            </div>
            {{-- bank_name input --}}
            <div class="col-md-6 col-12">
                <div class="mb-3">
                    <label class="control-label">@lang('bank_name'):</label>
                    <x-input name="bank_name" :value="$driver->bank_name ?? old('bank_name')"
                             :placeholder="__('bank_name')"/>
                </div>
            </div>
            {{-- bank_account_name input --}}
            <div class="col-md-6 col-12">
                <div class="mb-3">
                    <label class="control-label">@lang('bank_account_name'):</label>
                    <x-input name="bank_account_name" :value="$driver->bank_account_name ?? old('bank_account_name')"
                             :placeholder="__('bank_account_name')"/>
                </div>
            </div>
            {{-- bank_account_number input --}}
            <div class="col-md-6 col-12">
                <div class="mb-3">
                    <label class="control-label">@lang('bank_account_number'):</label>
                    <x-input name="bank_account_number"
                             :value="$driver->bank_account_number ?? old('bank_account_number')"
                             :placeholder="__('bank_account_number')"/>
                </div>
            </div>
            <!-- address -->
            <div class="col-12">
                <div class="mb-3">
                    <x-input-pick-address :label="trans('pickup_address')" name="address" :value="$driver->current_address"
                                          :placeholder="trans('pickup_address')" :required="true" />
                    <x-input type="hidden" name="lat" :value="$driver->current_lat" />
                    <x-input type="hidden" name="lng" :value="$driver->current_lng" />
                </div>
            </div>
        </div>
    </div>
    <div class="card mt-3">
        <div class="card-header fw-bold d-flex align-items-center">
            <span>@lang('user_information')</span>
            <x-link :href="route('admin.user.edit',$driver->user_id)" style="margin-left: 12px" class="">
                <span class="ms-1">Chỉnh sửa </span>
            </x-link>
        </div>
        <div class="row card-body">
            {{-- id_card input --}}
            <div class="col-md-6 col-12">
                <div class="mb-3">
                    <label class="control-label">@lang('fullname'):</label>
                    <x-input disabled name="fullname" :value="$driver->user->fullname" :required="true"
                             :placeholder="__('fullname')"/>
                </div>
            </div>
            <div class="col-md-6 col-12">
                <div class="mb-3">
                    <label class="control-label">@lang('phone'):</label>
                    <x-input disabled name="phone" :value="$driver->user->phone" :required="true"
                             :placeholder="__('phone')"/>
                </div>
            </div>
            <!-- Area -->
            <div class="col-md-6 col-12">
                <div class="mb-3">
                    <label class="control-label">@lang('area'):</label>
                    <x-select disabled name="area_id" :required="true">
                        @foreach ($areas as $area)
                            <x-select-option :value="$area->id" :title="$area->name"
                                             :selected="$area->id == $driver->user->area_id"/>
                        @endforeach
                    </x-select>
                </div>
            </div>
            {{-- birthday--}}
            <div class="col-md-6 col-12">
                <div class="mb-3">
                    <label class="control-label">@lang('birthday'):</label>
                    <x-input disabled type="date" name="birthday" :value="format_date($driver->user->birthday, 'Y-m-d')" />

                </div>
            </div>
            <!-- gender -->
            <div class="col-md-6 col-12">
                <div class="mb-3">
                    <label class="control-label">@lang('gender'):</label>
                    <x-select disabled name="gender" :required="true">
                        @foreach ($gender as $key => $value)
                            <x-select-option :option="$driver->user->gender->value" :value="$key" :title="__($value)" />
                        @endforeach
                    </x-select>
                </div>
            </div>
            <!-- roles -->
            <div class="col-md-6 col-12">
                <div class="mb-3">
                    <label class="control-label">@lang('role'):</label>
                    <x-select disabled name="roles" :required="true">
                        @foreach ($roles as $key => $value)
                            <x-select-option :option="$driver->user->roles->value" :value="$key" :title="__($value)" />
                        @endforeach
                    </x-select>
                </div>
            </div>
        </div>
    </div>
    <div class="card mt-3">
        <div class="card-header fw-bold d-flex align-items-center justify-content-between">
            <span >@lang('Tỉ lệ hoạt động')</span>
            <x-link :href="route('admin.order.orderDriverHistory',$driver->id)" class="btn btn-info" type="button" onclick="">
                @lang('view_order_history')
            </x-link>
        </div>
        <div class="row card-body">
            <div class="col-md-4 col-12">
                <div class="mb-3">
                    <label class="control-label">@lang('Tỉ lệ nhận đơn'):</label>
                        @foreach ($rates as $rate)
                            <x-input name="order_acceptance_rate" :value="$rate->order_acceptance_rate" readonly />
                        @endforeach
                </div>
            </div>
            <div class="col-md-4 col-12">
                <div class="mb-3">
                    <label class="control-label">@lang('Tỉ lệ hoàn thành đơn'):</label>
                        @foreach ($rates as $rate)
                            <x-input name="order_completion_rate" :value="$rate->order_completion_rate" readonly />
                        @endforeach
                </div>
            </div>
            <div class="col-md-4 col-12">
                <div class="mb-3">
                    <label class="control-label">@lang('Tỉ lệ hủy đơn'):</label>
                        @foreach ($rates as $rate)
                            <x-input name="order_cancellation_rate" :value="$rate->order_cancellation_rate" readonly />
                        @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
