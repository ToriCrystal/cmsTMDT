<?php

namespace App\Api\V1\Services\DriverTransaction;

use App\Api\V1\Repositories\DriverTransaction\TransactionRepositoryInterface;
use App\Enums\Driver\DriverTransactionStatus;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;

class TransactionService implements TransactionServiceInterface
{
    /**
     * Current Object instance
     *
     * @var array
     */
    protected $data;

    protected $repository;

    protected $instance;


    public function __construct(TransactionRepositoryInterface $repository,

    )
    {
        $this->repository = $repository;

    }

    /**
     * @throws Exception
     */
    public function store(Request $request)
    {
        $data = $request->validated();
        $currentDateTime = Carbon::now();
        if ($currentDateTime->hour >= 19) {
            $data['status'] = DriverTransactionStatus::Late;
        } else {
            $data['status'] = DriverTransactionStatus::Success;
        }

        return $this->repository->create($data);
    }


    /**
     * @throws Exception
     */
    public function update(Request $request)
    {
        $data = $request->validated();

        return $this->repository->update($data['user_id'], $data);

    }

    public function delete($id): object|bool
    {
        return $this->repository->delete($id);

    }

    public function getInstance()
    {
        return $this->instance;
    }


}
