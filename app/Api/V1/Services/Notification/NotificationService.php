<?php

namespace App\Api\V1\Services\Notification;

use App\Api\V1\Repositories\Notification\NotificationRepositoryInterface;
use App\Api\V1\Repositories\User\UserRepositoryInterface;
use Illuminate\Http\Request;

class NotificationService implements NotificationServiceInterface
{
    /**
     * Current Object instance
     *
     * @var array
     */
    protected $data;

    protected $repository;

    protected $instance;

    private UserRepositoryInterface $userRepository;

    public function __construct(NotificationRepositoryInterface $repository,
                                UserRepositoryInterface         $userRepository
    )
    {
        $this->repository = $repository;
        $this->userRepository = $userRepository;

    }

    public function store(Request $request)
    {
        $data = $request->validated();
        return $this->repository->create($data);
    }


    /**
     * @throws \Exception
     */
    public function update(Request $request)
    {
        $data = $request->validated();

        return $this->userRepository->update($data['user_id'], $data);

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
