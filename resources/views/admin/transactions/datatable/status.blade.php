<span @class([
    'badge',
    App\Enums\Driver\DriverTransactionStatus::from($status)->badge(),
])>{{ \App\Enums\Driver\DriverTransactionStatus::getDescription($status) }}</span>
