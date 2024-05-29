<?php

namespace App\Admin\DataTables\UserDriver;

use App\Admin\DataTables\BaseDataTable;
use App\Admin\Repositories\UserDriver\UserDriverRepositoryInterface;
use App\Enums\User\UserRole;

class NewDriverDataTable extends BaseDataTable
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

        ];
    }

    public function setColumnSearch()
    {

        $this->columnAllSearch = [0, 1, 3,4];

        $this->columnSearchDate = [3];

        $this->columnSearchSelect = [


        ];
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        $query = $this->repository->getQueryBuilderOrderBy();

        return $query->whereHas('user', function ($query) {
            $query->where('roles', UserRole::Customer->value);
        });
    }

    protected function setCustomColumns()
    {
        $this->customColumns = config('datatables_columns.driver', []);
    }

    protected function setCustomEditColumns()
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
            'created_at' => '{{ format_date($created_at) }}'
        ];
    }

    protected function setCustomAddColumns()
    {
        $this->customAddColumns = [
            'action' => $this->view['action'],
        ];
    }

    protected function setCustomRawColumns()
    {
        $this->customRawColumns = ['fullname', 'action','roles'];
    }

    public function setCustomFilterColumns()
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
