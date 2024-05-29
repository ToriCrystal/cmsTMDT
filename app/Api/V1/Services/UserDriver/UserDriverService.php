<?php

namespace App\Api\V1\Services\UserDriver;

use App\Api\V1\Repositories\User\UserRepositoryInterface;
use App\Api\V1\Repositories\UserDriver\UserDriverRepositoryInterface;
use App\Enums\Gender;
use App\Events\UserDriverCreated;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PHPUnit\Exception;

class UserDriverService implements UserDriverServiceInterface
{
    /**
     * Current Object instance
     *
     * @var array
     */
    protected $data;

    protected $repository;

    protected $instance;

    protected UserRepositoryInterface $userRepository;

    public function __construct(UserDriverRepositoryInterface $repository, UserRepositoryInterface $userRepository)
    {
        $this->repository = $repository;
        $this->userRepository = $userRepository;
    }

    public function store(Request $request)
    {
        $data = $request->validated();

        try {
            DB::beginTransaction();

            $user = [
                'fullname' => $data['fullname'],
                'phone' => $data['phone'],
                'password' => bcrypt($data['password']),
                'area_id' => $data['area_id'],
                'gender' => Gender::Male,
            ];
            $user = $this->userRepository->create($user);

            unset($data['fullname'], $data['phone'], $data['password'], $data['area_id']);

            $data['user_id'] = $user->id;

            $userDriver = $this->repository->create($data);

            event(new UserDriverCreated($userDriver));

            DB::commit();

        } catch (Exception $e) {
            DB::rollBack();
            return false;
        }

        return $userDriver;
    }

    public function update($id, Request $request)
    {

        $driver = $this->repository->findByOrFail(['id' => $id]);
        if ($driver) {
            $data = $request->validated();
            $this->repository->update($id, $data);
            return $driver->refresh();
        }
        return null;

    }

    public function delete($id)
    {
        return $this->repository->delete($id);

    }

    public function getInstance()
    {
        return $this->instance;
    }


    public function findById($id)
    {
        try {
            return $this->repository->findByOrFail(['id' => $id]);
        } catch (ModelNotFoundException $e) {
            return response()->json(
                [
                    'status' => 404,
                    'message' => 'Không tìm thấy tài xế.',
                ]
                , 404
            );
        }
    }
}
