<?php

namespace App\Admin\DataTables\Store\Category;

use App\Admin\DataTables\BaseDataTable;
use App\Admin\Repositories\StoreCategory\StoreCategoryRepositoryInterface;
use App\Enums\DefaultStatus;

class StoreCategoryDataTable extends BaseDataTable
{

    protected $nameTable = 'storeCatTable';

    public function __construct(
        StoreCategoryRepositoryInterface $repository
    ){
        $this->repository = $repository;
        
        parent::__construct();

    }

    public function setView(){
        $this->view = [
            'action' => 'admin.stores.categories.datatable.action',
            'name' => 'admin.stores.categories.datatable.name',
            'status' => 'admin.stores.categories.datatable.status',
        ];
    }

    public function setColumnSearch(){

        $this->columnAllSearch = [0, 1, 2, 3];

        $this->columnSearchDate = [3];

        $this->columnSearchSelect = [
            [
                'column' => 2,
                'data' => DefaultStatus::asSelectArray()
            ]
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
        return $this->repository->getQueryBuilderOrderBy('position', 'asc');
    }

    protected function setCustomColumns(){
        $this->customColumns = config('datatables_columns.store_category', []);
    }

    protected function setCustomEditColumns(){
        $this->customEditColumns = [
            'name' => $this->view['name'],
            'status' => $this->view['status'],
            'created_at' => '{{ format_date($created_at) }}'
        ];
    }

    protected function setCustomAddColumns(){
        $this->customAddColumns = [
            'action' => $this->view['action'],
        ];
    }

    protected function setCustomRawColumns(){
        $this->customRawColumns = ['name', 'status', 'action'];
    }
}