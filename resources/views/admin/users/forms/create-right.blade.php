<div class="col-12 col-md-3">
    <div class="card mb-3">
        <div class="card-header">
            @lang('action')
        </div>
        <div class="card-body p-2">
            <div class="d-flex align-items-center h-100 gap-2">
                <x-button.submit :title="__('save')" name="submitter" value="save"/>
                <x-button type="submit" name="submitter" value="saveAndExit">
                    @lang('save&exit')
                </x-button>
            </div>
        </div>
    </div>
    <div class="card mb-3">
        <div class="card-header">
            @lang('avatar')
        </div>
        <div class="card-body p-2">
            <x-input-image-ckfinder name="feature_image" showImage="featureImage"/>
        </div>
    </div>
    <div class="card mb-3">
        <div class="card-header">
            @lang('notifications')
        </div>
        <div class="card-body p-2">
            <x-input-switch label="{{ __('notification_preference') }}" name="notification_preference"
                            :value="\App\Enums\User\AutoNotification::Auto->value"
                            :checked="old('notification_preference', 1)"/>
        </div>
    </div>
</div>
