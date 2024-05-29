<style>
    .hidden {
        display: none !important;
    }
</style>
<div class="col-12 col-md-9">
    <div class="card">
        <div class="row card-body">
            <!-- Code -->
            <x-input type="hidden" name="id" :value="$order->id"/>
            <div class="col-md-6 col-12">
                <div class="mb-3">
                    <label class="control-label">@lang('orderCode'):</label>
                    <x-input disabled name="code" :value="$order->code" :required="true"
                             :placeholder="__('orderCode')"/>
                </div>
            </div>
            <!-- create_at -->
            <div class="col-md-6 col-12">
                <div class="mb-3">
                    <label class="control-label">@lang('createAt'):</label>
                    <x-input type="date" name="created_at" :value="format_date($order->created_at, 'Y-m-d')"
                             :required="true"/>
                </div>
            </div>
            <!-- pickup_address -->
            <x-input-pick-address :label="trans('address')" name="pickup_address"
                                  :value="$order->pickup_address"
                                  :placeholder="trans('pickAddress')"
                                  :required="true"/>
            <x-input type="hidden" name="lat" :value="$order->lat"/>
            <x-input type="hidden" name="lng" :value="$order->lng"/>
            <!-- store -->
            <div class="col-md-12 col-12  mt-3">
                <div class="mb-3">
                    <label class="control-label">@lang('store'):</label>
                    <x-select disabled id="store-select" name="store_id" class="select2-bs5-ajax-many"
                              :required="true">
                        <x-select-option :option="$order->store_id" :value="$order->store_id"
                                         :title="$order->store->store_name "/>
                    </x-select>
                </div>
            </div>
            <!-- destination_address -->
            <div class="col-12">
                <div class="mb-3">
                    <label class="control-label">@lang('pickDestinationAddress'):</label>
                    <x-input readonly id="destination_address"
                             type="text"
                             name="destination_address"
                             :value="$order->destination_address"
                             :required="true"/>
                    <x-input type="hidden" name="destination_lat" :value="$order->store->lat"/>
                    <x-input type="hidden" name="destination_lng" :value="$order->store->lng"/>
                </div>
            </div>
            <!-- show map -->
            <div id="resultMap" class="w-100 hidden" style="height: 400px"></div>
            <!-- detail map-->
            <div id="directions-panel"></div>

            <!-- customer -->
            <div class="col-md-6 col-12 mt-3">
                <div class="mb-3">
                    <label class="control-label">@lang('customer'):</label>
                    <x-select disabled name="customer_id" class="select2-bs5-ajax-many"
                              :required="true">
                        <x-select-option :option="$order->customer_id" :value="$order->customer_id"
                                         :title="$order->customer->fullname . ' - ' . $order->customer->phone"/>
                    </x-select>
                </div>
            </div>



            <!-- shipping_method -->
            <div class="col-md-6 col-12 mt-3">
                <div class="mb-3">
                    <label class="control-label">@lang('shipping'):</label>
                    <x-select name="shipping_method" :required="true">
                        @foreach ($shipping as $key => $value)
                            <x-select-option :option="$order->shipping_method->value" :value="$key"
                                             :title="__($value)"/>
                        @endforeach
                    </x-select>
                </div>
            </div>
            <!-- payment_method -->
            <div class="col-md-6 col-12">
                <div class="mb-3">
                    <label class="control-label">@lang('payment'):</label>
                    <x-select name="payment_method" :required="true">
                        @foreach ($payment as $key => $value)
                            <x-select-option :option="$order->payment_method->value" :value="$key" :title="__($value)"/>
                        @endforeach
                    </x-select>
                </div>
            </div>
            <!-- sub_total -->
            <div class="col-md-6 col-12">
                <div class="mb-3">
                    <label class="control-label">@lang('sub_total'):</label>
                    <x-input id="sub_total" type="number" name="sub_total" :value="$order->sub_total"
                             :required="true"/>
                </div>
            </div>
            <!-- transport_fee -->
            <div class="col-md-6 col-12">
                <div class="mb-3">
                    <label class="control-label">@lang('transport_fee'):</label>
                    <x-input id="transport_fee"  type="number" name="transport_fee" :value="$order->transport_fee"
                             :required="true"/>
                </div>
            </div>

            <!-- system_revenue -->
            <div class="col-md-6 col-12">
                <div class="mb-3">
                    <label class="control-label">@lang('system_revenue'):</label>
                    <x-input id="system_revenue" type="number" name="system_revenue" :value="$order->system_revenue"
                             :required="true"/>
                </div>
            </div>
            <!-- total -->
            <div class="col-md-12 col-12">
                <div class="mb-3">
                    <label class="control-label">@lang('total'):</label>
                    <x-input id="total" type="number" name="total" :value="$order->total"
                             :required="true"/>
                </div>
            </div>
        </div>
    </div>
</div>
