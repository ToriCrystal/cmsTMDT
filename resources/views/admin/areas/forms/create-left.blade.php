<div class="col-12 col-md-9">
    <div class="card">
        <div class="row card-body">
            <!-- title -->
            <div class="col-12">
                <div class="mb-3">
                    <label class="control-label">@lang('name')</label>
                    <x-input name="name" :value="old('name')" :required="true" :placeholder="__('name')"/>
                </div>
            </div>
            <!-- address -->
            <div class="col-12">
                <div class="mb-3">
                    <x-input-pick-address :label="trans('address')" name="address" :placeholder="trans('pickAddress')"
                                          :required="true"/>
                    <x-input type="hidden" name="lat"/>
                    <x-input type="hidden" name="lng"/>
                </div>
            </div>
            <!-- shipping_fee -->
            <div class="col-12">
                <label class="control-label">@lang('shipping_fee'):</label>
                <x-input-price id="shipping_fee" name="shipping_fee" :required="true"/>
            </div>
        </div>
    </div>
</div>
