<div class="col-12 col-md-9">
    <div class="card">
        <div class="card-header justify-content-center">
            <h2 class="mb-0">{{ __('Tuỳ chỉnh nhóm topping') }}</h2>
        </div>
        <div class="row card-body">
            <!-- name -->
            <input type="hidden" name="store_id" value="{{$store_id->id}}"/>
            <input type="hidden" name="id" value="{{$page->id}}"/>
            <div class="col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Loại') }}:</label></br>
                    @if($page->type==1)
                         <input type="radio"  name="type" value="2">
                         <label>Chọn nhiều</label>
                         <input type="radio" name="type" value="1" checked>
                         <label>Chọn 1</label><br>
                    @else
                    <input type="radio"  name="type" value="2" checked>
                         <label>Chọn nhiều</label>
                         <input type="radio" name="type" value="1">
                         <label>Chọn 1</label><br>
                    @endif
                </div>
            </div>
            <!-- link -->
            <div class="col-6">
                       <div class="mb-3">
                           <label class="control-label">@lang('name')</label>
                           <x-input name="name" :value="$page->name" :required="true" :placeholder="__('name')" />
                       </div>
                   </div>
            <!-- position -->
            <div class="col-md-12 col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Bắt buộc') }}:</label></br>
                    @if($page->obligatory==0)
                    <input type="checkbox" name="obligatory" style="transform: scale(1.5);" checked>
                    @else
                    <input type="checkbox" name="obligatory" style="transform: scale(1.5);">
                    @endif
                </div>
            </div>   
        </div>
    </div>
</div>