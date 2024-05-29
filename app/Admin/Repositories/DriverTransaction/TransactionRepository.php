<?php

namespace App\Admin\Repositories\DriverTransaction;

use App\Admin\Repositories\EloquentRepository;
use App\Enums\Driver\DriverTransactionStatus;
use App\Enums\Order\OrderStatus;
use App\Models\DriverTransaction;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;


class TransactionRepository extends EloquentRepository implements TransactionRepositoryInterface
{
    public function getModel(): string
    {
        return DriverTransaction::class;
    }

    public function getByOrder(array $filter, array $relations = [], $sort = ['id', 'desc'])
    {
        $this->getByQueryBuilder($filter, $relations, $sort);

        return $this->instance->get();
    }

    public function searchAllLimit($keySearch = '', $meta = [], $limit = 10)
    {

        $this->instance = $this->model->where('name', 'like', '%' . $keySearch . '%');

        $this->applyFilters($meta);

        return $this->instance->published()->orderBy('position', 'asc')->limit($limit)->get();
    }



    public function getLateTransactions(): Collection
    {
        $yesterdayLate = Carbon::yesterday()->setHour(17)->setMinute(0)->setSecond(0);
        $endOfToday = Carbon::today()->endOfDay();
        return DB::table('driver_transactions')
            ->where('status', DriverTransactionStatus::Pending)
            ->where('created_at', '>', $yesterdayLate)
            ->where('created_at', '<=', $endOfToday)
            ->get();
    }
}
