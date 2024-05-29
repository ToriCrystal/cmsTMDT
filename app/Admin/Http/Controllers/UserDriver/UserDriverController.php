<?php

namespace App\Admin\Http\Controllers\UserDriver;

use App\Admin\DataTables\UserDriver\NewDriverDataTable;
use App\Admin\DataTables\UserDriver\UserDriverDataTable;
use App\Admin\Http\Controllers\Controller;
use App\Admin\Http\Requests\UserDriver\UserDriverRequest;
use App\Admin\Repositories\Area\AreaRepositoryInterface;
use App\Admin\Repositories\UserDriver\UserDriverRepositoryInterface;
use App\Admin\Services\UserDriver\UserDriverServiceInterface;
use App\Enums\Driver\DriverStatus;
use App\Enums\Gender;
use App\Enums\User\UserRole;
use App\Models\Rates;

class UserDriverController extends Controller
{

    protected  AreaRepositoryInterface $areaRepository;
    public function __construct(
        UserDriverRepositoryInterface $repository,
        UserDriverServiceInterface    $service,
        AreaRepositoryInterface $areaRepository

    )
    {

        parent::__construct();

        $this->repository = $repository;
        $this->service = $service;
        $this->areaRepository = $areaRepository;
    }

    public function getView(): array
    {

        return [
            'index' => 'admin.userDrivers.index',
            'create' => 'admin.userDrivers.create',
            'edit' => 'admin.userDrivers.edit',
            'newDriver' => 'admin.userDrivers.newDrivers'
        ];
    }

    public function getRoute(): array
    {

        return [
            'index' => 'admin.driver.index',
            'newDriver' => 'admin.driver.newDriver',
            'create' => 'admin.driver.create',
            'edit' => 'admin.driver.edit',
            'delete' => 'admin.driver.delete'
        ];
    }
    public function newDrivers(NewDriverDataTable $dataTable)
    {

        return $dataTable->render($this->view['newDriver'], [
            'breadcrums' => $this->crums->add(__('page'))
        ]);
    }

    public function index(UserDriverDataTable $dataTable)
    {

        return $dataTable->render($this->view['index'], [
            'breadcrums' => $this->crums->add(__('page'))
        ]);
    }

    public function create()
    {
        return view($this->view['create'], [
            'order_accepted' =>DriverStatus::asSelectArray(),
            'breadcrums' => $this->crums->add(__('driver'), route($this->route['index']))->add(__('add'))
        ]);
    }

    public function store(UserDriverRequest $request)
    {
        $response = $this->service->store($request);

        if ($response) {
            return $request->input('submitter') == 'save'
                ? to_route($this->route['edit'], $response->id)->with('success', __('notifySuccess'))
                : to_route($this->route['index'])->with('success', __('notifySuccess'));
        }



        return back()->with('error', __('notifyFail'))->withInput();


    }

    public function edit($id)
    {
        $driver = $this->repository->findOrFail($id);
        $areas = $this ->areaRepository->getAll();
        $rates = Rates::where('user_id', $id)->get();
        return view(
            $this->view['edit'],
            [
                'gender' => Gender::asSelectArray(),
                'roles' => UserRole::asSelectArray(),
                'order_accepted' =>DriverStatus::asSelectArray(),
                'areas' => $areas,
                'driver' => $driver,
                'breadcrums' => $this->crums->add(__('driver'), route($this->route['index']))->add(__('edit')),
                'rates' => $rates
            ],
        );
    }

    public function update(UserDriverRequest $request)
    {

        $response = $this->service->update($request);

        if ($response) {
            return $request->input('submitter') == 'save'
                ? back()->with('success', __('notifySuccess'))
                : to_route($this->route['index'])->with('success', __('notifySuccess'));
        }

        return back()->with('error', __('notifyFail'));
    }

    public function delete($id)
    {
        $driver = $this->repository->findOrFail($id);
        $this->service->delete($id, $driver->user->id);

        return to_route($this->route['index'])->with('success', __('notifySuccess'));
    }
}
