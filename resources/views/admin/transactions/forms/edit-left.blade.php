<style>
    .image-contain + img {
        height: 500px !important;
        object-fit: contain !important;
    }
</style>
<div class="col-12 col-md-9">
    <div class="card">
        <div class="row card-body">
            <!-- Code -->
            <div class="col-md-6 col-12">
                <div class="mb-3">
                    <label class="control-label">@lang('orderCode'):</label>
                    <x-link :href="route('admin.order.edit', $transaction->order->id)"
                            :title="$transaction->order->code"/>
                </div>
            </div>
            <!-- driver -->
            <div class="col-md-6 col-12">
                <div class="mb-3">
                    <label class="control-label">@lang('driver'):</label>
                    <x-link :href="route('admin.driver.edit', $transaction->driver_id)"
                            :title="$transaction->driver->user->fullname"/>

                </div>
            </div>
            <!-- transaction_code -->
            <div class="col-12">
                <div class="mb-3">
                    <label class="control-label">@lang('transaction_code')</label>
                    <x-input name="transaction_code" :value="$transaction->transaction_code"
                             :placeholder="__('transaction_code')"/>
                </div>
            </div>
            <!-- amount -->
            <div class="col-12">
                <div class="mb-3">
                    <label class="control-label">@lang('amount_transferred')</label>
                    <x-input-price id="amount" name="amount" :value="$transaction->amount"
                                   :placeholder="__('amount_transferred')"/>
                </div>
            </div>
            <!-- image -->
            <div class="col-12 col-md-6">
                <div class="mb-3">
                    <label class="control-label">{{ __('Hình ảnh') }}:</label>
                    <x-input-image-ckfinder name="feature_image"
                                            class="image-contain"
                                            showImage="image"
                                            :value="$transaction->feature_image"/>
                </div>
            </div>
            <!-- description -->
            <div class="col-12 col-md-6 ">
                <div class="mb-3">
                    <label class="control-label">@lang('description')</label>
                    <x-input name="description" :value="$transaction->description"
                             :placeholder="__('description')"/>
                </div>
            </div>
        </div>
    </div>

</div>
