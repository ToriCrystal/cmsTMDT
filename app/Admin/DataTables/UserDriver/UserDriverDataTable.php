<?php

namespace App\Admin\DataTables\UserDriver;

use App\Admin\DataTables\BaseDataTable;
use App\Admin\Repositories\UserDriver\UserDriverRepositoryInterface;
use App\Enums\Driver\AutoAccept;
use App\Enums\Driver\DriverStatus;
use App\Enums\User\UserRole;
use Illuminate\Database\Eloquent\Builder;

class UserDriverDataTable extends BaseDataTable
{

    protected $nameTable = 'userDriverInfoTable';

    public function __construct(
        UserDriverRepositoryInterface $repository
    )
    {
        $this->repository = $repository;

        parent::__construct();
    }

    public function setView()
    {
        $this->view = [
            'action' => 'admin.userDrivers.datatable.action',
            'fullname' => 'admin.userDrivers.datatable.fullname',
            'role' => 'admin.userDrivers.datatable.role',
            'status' => 'admin.userDrivers.datatable.status',
            'auto_accept' => 'admin.userDrivers.datatable.auto_accept',

        ];
    }

    public function setColumnSearch(): void
    {

        $this->columnAllSearch = [0, 1, 2, 4, 5,6];

        $this->columnSearchDate = [6];

        $this->columnSearchSelect = [

            [
                'column' => 4,
                'data' => DriverStatus::asSelectArray()
            ],
            [
                'column' => 5,
                'data' => AutoAccept::asSelectArray()
            ],
        ];
    }

    /**
     * Get query source of dataTable.
     *
     * @return Builder
     */
    public function query(): Builder
    {
        $query = $this->repository->getQueryBuilderOrderBy();

        return $query->whereHas('user', function ($query) {
            $query->where('roles', UserRole::Driver);
        });
    }


    protected function setCustomColumns(): void
    {
        $this->customColumns = config('datatables_columns.driver', []);
    }

    protected function setCustomEditColumns(): void
    {
        $this->customEditColumns = [
            'fullname' => function ($driver) {
                return view($this->view['fullname'], [
                    'id' => $driver->id,
                    'fullname' => $driver->user->fullname,
                ])->render();
            },
            'roles' => function ($driver) {
                return view($this->view['role'], [
                    'role' => $driver->user->roles->value,
                ])->render();
            },

            'order_accepted' => function ($driver) {
                return view($this->view['status'], [
                    'status' => $driver->order_accepted->value,
                ])->render();
            },
            'auto_accept' => function ($driver) {
                return view($this->view['auto_accept'], [
                    'status' => $driver->auto_accept->value,
                ])->render();
            },
            'created_at' => '{{ format_date($created_at) }}'
        ];
    }

    protected function setCustomAddColumns(): void
    {
        $this->customAddColumns = [
            'action' => $this->view['action'],
        ];
    }

    protected function setCustomRawColumns(): void
    {
        $this->customRawColumns = ['fullname', 'action', 'roles','order_accepted','auto_accept'];
    }

    public function setCustomFilterColumns(): void
    {
        $this->customFilterColumns = [
            'fullname' => function ($query, $keyword) {
                $query->whereHas('user', function ($subQuery) use ($keyword) {
                    $subQuery->where('fullname', 'like', '%' . $keyword . '%');
                });
            },
            'roles' => function ($query, $keyword) {
                $query->whereHas('user', function ($subQuery) use ($keyword) {
                    $subQuery->where('roles', 'like', '%' . $keyword . '%');
                });
            },

        ];
    }
}
