<div class="col-12 col-md-3">
    <div class="card">
        <div class="card-header">
            @lang('action')
        </div>
        <div class="card-body p-2 d-flex justify-content-between">
            <div class="d-flex align-items-center h-100 gap-2">
                <x-button.submit :title="__('save')" name="submitter" value="save" />
                <x-button type="submit" name="submitter" value="saveAndExit">
                    @lang('save&exit')
                </x-button>
            </div>
            <x-button.modal-delete data-route="{{ route('admin.user.delete', $user->id) }}" :title="__('delete')" />
        </div>
    </div>
    <div class="card ">
        <div class="card-body p-2">
            <x-link :href="route('admin.user.orderHistory',$user->id)" class="btn btn-info" type="button" onclick="">
                @lang('view_order_history')
            </x-link>
        </div>
    </div>
    <!-- roles -->
    <div class="card ">
        <div class="card-header">
            @lang('role')
        </div>
        <div class="card-body p-2">
            <x-select name="roles" :required="true">
                @foreach ($roles as $key => $value)
                    <x-select-option :option="$user->roles->value" :value="$key" :title="__($value)" />
                @endforeach
            </x-select>
        </div>
    </div>
    <!-- avatar -->
    <div class="card mb-3">
        <div class="card-header">
            @lang('avatar')
        </div>
        <div class="card-body p-2">
            <x-input-image-ckfinder name="feature_image" showImage="featureImage" :value="$user->feature_image"/>
        </div>
    </div>
    <div class="card mb-3">
        <div class="card-header">
            @lang('notifications')
        </div>

        <div class="card-body p-2">
            <x-input-switch label="{{ __('notification_preference') }}"
                            name="notification_preference"
                            :value="\App\Enums\User\AutoNotification::Auto->value"
                            :checked="$user->notification_preference === \App\Enums\User\AutoNotification::Auto"/>

        </div>
    </div>
</div>
