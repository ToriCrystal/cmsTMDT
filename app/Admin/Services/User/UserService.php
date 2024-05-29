<?php

namespace App\Admin\Services\User;

use App\Admin\Repositories\Cart\CartRepositoryInterface;
use App\Admin\Services\User\UserServiceInterface;
use  App\Admin\Repositories\User\UserRepositoryInterface;
use App\Enums\User\AutoNotification;
use Illuminate\Http\Request;

class UserService implements UserServiceInterface
{
    /**
     * Current Object instance
     *
     * @var array
     */
    protected $data;

    protected $repository;

    private CartRepositoryInterface $cartRepository;

    public function __construct(UserRepositoryInterface $repository,CartRepositoryInterface $cartRepository){
        $this->repository = $repository;
        $this->cartRepository = $cartRepository;
    }

    public function store(Request $request){

        $this->data = $request->validated();
        $this->data['password'] = bcrypt($this->data['password']);
        $this->data['feature_image'] = $request['feature_image'];

        $user = $this->repository->create($this->data);
        if (empty($this->data['notification_preference'])) {
            $this->data['notification_preference'] = AutoNotification::Off;
        }
        if ($user) {
            $cartData = ['user_id' => $user->id];
            $this->cartRepository->create($cartData);
        }
        return $user;
    }

    public function update(Request $request): object|bool
    {

        $this->data = $request->validated();

        if(isset($this->data['password']) && $this->data['password']){
            $this->data['password'] = bcrypt($this->data['password']);
        }else{
            unset($this->data['password']);
        }
        if (!array_key_exists('notification_preference', $this->data)) {
            $this->data['notification_preference'] = AutoNotification::Off;
        }

        return $this->repository->update($this->data['id'], $this->data);

    }

    public function delete($id): object|bool
    {
        return $this->repository->delete($id);

    }

}
