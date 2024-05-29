<div class="card h-100">
    <div class="card-header justify-content-center">
        <h2 class="mb-0">{{ $title ?? __('setting') }}</h2>
    </div>
    <div class="row card-body wrap-loop-input">
        <div class="row card-body wrap-loop-input">
            <x-input-switch label="{{ __('notification_preference') }}"
                            name="notification_preference"
                            :value="1"
                            :checked="(old('notification_preference', $notificationPreference) == 1)" />

        </div>

    </div>
</div>

