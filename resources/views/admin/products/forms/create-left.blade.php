<div class="col-12 col-md-9">
    <div class="row">
       <div class="col-12">
           <div class="card">
               <div class="card-header">
                   @lang('name') &  @lang('status')
               </div>
               <div class="card-body row">
                   <!-- name -->
                   <div class="col-12">
                       <div class="mb-3">
                           <label class="control-label">@lang('name')</label>
                           <x-input name="name" :value="old('name')" :required="true" :placeholder="__('name')" />
                       </div>
                   </div>
                   <!--Sku-->
                   <div class="col-6">
                       <div class="mb-3">
                           <label class="control-label">@lang('Sku')</label>
                           <x-input name="sku" :value="old('sku')" :required="true" :placeholder="__('sku')" />
                       </div>
                   </div>
                   <!-- stock -->
                   <div class="col-md-6 col-12">
                       <div class="mb-3">
                           <label class="control-label">@lang('status'):</label>
                           <x-select name="in_stock" :required="true">
                               @foreach ($stocks as $key => $value)
                                   <x-select-option :value="$key" :title="__($value)" />
                               @endforeach
                           </x-select>
                       </div>
                   </div>
               </div>
           </div>
       </div>
        <div class="col-12 mt-3">
            <div class="card">
                <div class="card-header">
                    @lang('Giá')
                </div>
                <div class="card-body row">
                    <!-- price -->
                    <div class="col-6">
                        <div class="mb-3">
                            <label class="control-label">@lang('price')</label>
                            <x-input type="number" name="price" :value="old('price', 0)"  />
                        </div>
                    </div>
                    <!-- price_selling -->
                    <div class="col-6">
                        <div class="mb-3">
                            <label class="control-label">@lang('priceSelling')</label>
                            <x-input type="number" name="price_selling" :value="old('price_selling', 0)"  />
                        </div>
                    </div>
                    <!-- price_promotion -->
                    <div class="col-6">
                        <div class="mb-3">
                            <label class="control-label">@lang('pricePromotion')</label>
                            <x-input type="number" name="price_promotion" :value="old('price_promotion', 0)"  />
                        </div>
                    </div>
                    <!--qty-->
                    <div class="col-6">
                        <div class="mb-3">
                            <label class="control-label">@lang('qty'):</label>
                            <x-input type="number" name="qty" :value="old('qty', 0)" :required="true" />
                        </div>
                    </div>
                </div>
            </div>
        </div>

       <div class="col-12 mt-3">
           <div class="card">
               <div class="card-header">
                   @lang('position')
               </div>
               <div class="card-body row">
                   <!-- longitude -->
                   <div class="col-12">
                       <div class="mb-3">
                           <label class="control-label">@lang('longitude')</label>
                           <x-input name="longitude" :value="old('longitude')" :placeholder="__('longitude')" />
                       </div>
                   </div>
                   <!-- longitude -->
                   <div class="col-12">
                       <div class="mb-3">
                           <label class="control-label">@lang('latitude')</label>
                           <x-input name="latitude" :value="old('latitude')"  :placeholder="__('latitude')" />
                       </div>
                   </div>
               </div>
           </div>
       </div>
        <div class="col-12 mt-3">
            <div class="card">
                <div class="card-header">
                    @lang('category') & @lang('store')
                </div>
                <div class="card-body row">
                    <!-- Category -->
                    <div class="col-md-6 col-12">
                        <div class="mb-3">
                            <label class="control-label">@lang('category'):</label>
                            <x-select name="category_id" :required="true">
                                @foreach ($categories as $category)
                                    <x-select-option :value="$category->id" :title="$category->name" />
                                @endforeach
                            </x-select>
                        </div>
                    </div>
                    <!-- store -->
                    <div class="col-md-6 col-12">
                        <div class="mb-3">
                            <label class="control-label">@lang('store'):</label>
                            <x-select name="store_id" :required="true">
                                @foreach ($stores as $store)
                                    <x-select-option :value="$store->id" :title="$store->store_name" />
                                @endforeach
                            </x-select>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
