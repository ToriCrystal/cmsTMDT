<?php

namespace App\Admin\Services\UserDriver;

use App\Admin\Repositories\DriverTransaction\TransactionRepositoryInterface;
use App\Admin\Repositories\User\UserRepositoryInterface;
use App\Admin\Repositories\UserDriver\UserDriverRepository;
use App\Admin\Services\DriverTransaction\TransactionServiceInterface;
use App\Enums\Driver\AutoAccept;
use App\Enums\User\UserRole;
use App\Events\UserDriverCreated;
use Illuminate\Http\Request;

class UserDriverService implements UserDriverServiceInterface
{
    /**
     * Current Object instance
     *
     * @var array
     */
    protected $data;

    protected $repository;

    protected UserRepositoryInterface $userRepository;

    protected TransactionRepositoryInterface $transactionRepository;

    protected TransactionServiceInterface $transactionService;

    public function __construct(UserDriverRepository $repository,
                                TransactionRepositoryInterface $transactionRepository,
                                TransactionServiceInterface $transactionService,
                                UserRepositoryInterface $userRepository)
    {
        $this->repository = $repository;
        $this->userRepository = $userRepository;
        $this->transactionRepository = $transactionRepository;
        $this->transactionService = $transactionService;
    }

    public function store(Request $request)
    {

        $data = $request->validated();
        $userId = $data['user_id'];
        $this->userRepository->updateAttribute($userId, 'roles', UserRole::Driver->value);
        if (!isset($data['auto_accept'])) {
            $data['auto_accept'] = AutoAccept::Off;
        }
        $data['current_lat'] = $data['lat'];
        $data['current_lng'] = $data['lng'];
        $data['current_address'] = $data['address'];
        $userDriver = $this->repository->create($data);
        event(new UserDriverCreated($userDriver));

        return $userDriver;
    }

    public function update(Request $request)
    {
        $data = $request->validated();
        if (!array_key_exists('auto_accept', $data)) {
            $data['auto_accept'] = AutoAccept::Off->value;
        }
        $data['current_lat'] = $data['lat'];
        $data['current_lng'] = $data['lng'];
        $data['current_address'] = $data['address'];


        return $this->repository->update($data['id'], $data);
    }

    public function delete($id, $userId)
    {
        $this->userRepository->updateAttribute($userId, 'roles', UserRole::Customer->value);
        return $this->repository->delete($id);
    }

}
