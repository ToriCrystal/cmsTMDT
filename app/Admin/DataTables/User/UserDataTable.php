<?php

namespace App\Admin\DataTables\User;

use App\Admin\DataTables\BaseDataTable;
use App\Admin\Repositories\User\UserRepositoryInterface;
use App\Enums\Gender;

class UserDataTable extends BaseDataTable
{

    protected $nameTable = 'userTable';

    public function __construct(
        UserRepositoryInterface $repository
    ){
        $this->repository = $repository;

        parent::__construct();
    }

    public function setView(){
        $this->view = [
            'action' => 'admin.users.datatable.action',
            'fullname' => 'admin.users.datatable.fullname',
            'role' => 'admin.users.datatable.role',
            'area' => 'admin.users.datatable.area',

        ];
    }

    public function setColumnSearch(){

        $this->columnAllSearch = [0, 1, 2, 3, 5,6,7];

        $this->columnSearchDate = [6];

        $this->columnSearchSelect = [
            [
                'column' => 3,
                'data' => Gender::asSelectArray()
            ],

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
        return $this->repository->getQueryBuilderOrderBy();
    }

    protected function setCustomColumns(){
        $this->customColumns = config('datatables_columns.user', []);
    }

    protected function setCustomEditColumns(){
        $this->customEditColumns = [
            'fullname' => $this->view['fullname'],
            'gender' => function($user){
                return $user->gender->description();
            },
            'roles' => function ($user) {
                return view($this->view['role'], [
                    'role' => $user->roles->value,
                ])->render();
            },
            'area_id' => function($user) {
                $areaName = $user->area ? $user->area->name : 'N/A';
                return view($this->view['area'], ['area_name' => $areaName])->render();
            },
            'created_at' => '{{ format_date($created_at) }}'
        ];
    }

    protected function setCustomAddColumns(){
        $this->customAddColumns = [
            'action' => $this->view['action'],
        ];
    }

    protected function setCustomRawColumns(){
        $this->customRawColumns = ['fullname','area_id','action','roles'];
    }
    public function setCustomFilterColumns()
    {
        $this->customFilterColumns = [
            'area_id' => function ($query, $keyword) {
                $query->whereHas('area', function ($subQuery) use ($keyword) {
                    $subQuery->where('name', 'like', '%' . $keyword . '%');
                });
            },
        ];
    }
}
