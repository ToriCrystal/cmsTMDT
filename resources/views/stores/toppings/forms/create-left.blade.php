<div class="col-12 col-md-9">
    <div class="card">
        <div class="card-header justify-content-center">
            <h2 class="mb-0">{{ __('Tuỳ chỉnh nhóm topping') }}</h2>
        </div>
        <div class="row card-body">
            <!-- name -->
            <input type="hidden" name="store_id" value="{{$store_id->id}}"/>
            <div class="col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Loại') }}:</label></br>
                         <input type="radio"  name="type" value="2" style="transform: scale(1.5);">
                         <label> Chọn nhiều </label>
                         <input type="radio" name="type" value="1" style="transform: scale(1.5);">
                         <label> Chọn 1 </label><br>
                </div>
            </div>
            <!-- link -->
            <div class="col-6">
                       <div class="mb-3">
                           <label class="control-label">@lang('name')</label>
                           <x-input name="name" :value="old('name')" :required="true" :placeholder="__('name')" />
                       </div>
                   </div>
            <!-- position -->
            <div class="col-md-12 col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Bắt buộc') }}:</label></br>
                    <input type="checkbox" name="obligatory" value="1" checked style="transform: scale(1.5);">
                </div>
            </div>   
        </div>
    </div>
</div>