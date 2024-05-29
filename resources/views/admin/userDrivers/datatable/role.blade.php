<span @class([
    'badge',
    \App\Enums\User\UserRole::from($role)->badge(),
])>
    {{ \App\Enums\User\UserRole::getDescription($role) }}
    @if($role === \App\Enums\User\UserRole::Customer->value)
        (Chờ duyệt)
    @endif
</span>
