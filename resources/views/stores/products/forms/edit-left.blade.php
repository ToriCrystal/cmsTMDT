<div class="col-12 col-md-9">
<div class="row">
        <!-- name -->
        <h2 style="text-align: center; color: red;">Sửa thông tin món ăn</h2>
        <div class="col-12">
           <div class="card">
               <div class="card-header">
                   @lang('name') &  Trạng thái tồn kho
               </div>
               <div class="card-body row">
                <input type="hidden" name="store_id" value="{{$store_id->id}}"/>
                   <!-- name -->
                   <div class="col-6">
                       <div class="mb-3">
                           <label class="control-label">@lang('name')</label>
                           <x-input name="name" :value="$page->name" :required="true" :placeholder="__('name')" />
                       </div>
                   </div>
                   <div class="col-6">
                   <div class="mb-3">
                        <label class="form-label">@lang('category2'):</label>
                        <x-select name="category_id" :required="true">
                            @foreach ($store_categories as $store_category)
                                <x-select-option :value="$store_category->id" :title="$store_category->name" />
                            @endforeach
                        </x-select>
                    </div>
                   </div>
                   <!--Sku-->
                   <div class="col-6">
                       <div class="mb-3">
                           <label class="control-label">Đơn vị</label>
                           <x-input name="sku" :value="$page->sku" :required="true" :placeholder="__('Đơn vị')" />
                       </div>
                   </div>
                   <div class="col-md-6">
                       <div class="mb-3">
                           <label class="control-label">Trạng thái tồn kho:</label>
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
                            <x-input type="number" name="price" :value="$page->price"  />
                        </div>
                    </div>
                    <!-- price_selling -->
                    <div class="col-6">
                        <div class="mb-3">
                            <label class="control-label">@lang('priceSelling')</label>
                            <x-input type="number" name="price_selling" :value="$page->price_selling"  />
                        </div>
                    </div>
                    <!-- price_promotion -->
                    <div class="col-6">
                        <div class="mb-3">
                            <label class="control-label">@lang('pricePromotion')</label>
                            <x-input type="number" name="price_promotion" :value="$page->price_promotion"  />
                        </div>
                    </div>
                    <!--qty-->
                    <div class="col-6">
                        <div class="mb-3">
                            <label class="control-label">@lang('qty'):</label>
                            <x-input type="number" name="qty" :value="$page->qty" :required="true" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 mt-3">
           <div class="card">
               <div class="card-header">
                   Mô tả
               </div>
               <div class="card-body row">
                   <!-- longitude -->
                   <div class="col-12">
                        <div class="mb-3">
                            <label class="control-label">@lang('description')</label>
                            <textarea class="form-control" name="desc">{{ $page->desc }}</textarea>
                        </div>
                    </div>
               </div>
           </div>
       </div>
    </div>
</div>
