<?php

namespace App\Admin\DataTables\Area;

use App\Admin\DataTables\BaseDataTable;
use App\Admin\Repositories\Area\AreaRepositoryInterface;

class AreaDataTable extends BaseDataTable
{

    protected $nameTable = 'areaTable';

    public function __construct(
        AreaRepositoryInterface $repository
    ){
        $this->repository = $repository;
        
        parent::__construct();

    }

    public function setView(){
        $this->view = [
            'action' => 'admin.areas.datatable.action',
            'name' => 'admin.areas.datatable.name'
        ];
    }

    public function setColumnSearch(){

        $this->columnAllSearch = [0, 1, 2];

        $this->columnSearchDate = [2];
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
        $this->customColumns = config('datatables_columns.area', []);
    }

    protected function setCustomEditColumns(){
        $this->customEditColumns = [
            'name' => $this->view['name'],
            'created_at' => '{{ format_date($created_at) }}'
        ];
    }

    protected function setCustomAddColumns(){
        $this->customAddColumns = [
            'action' => $this->view['action'],
        ];
    }

    protected function setCustomRawColumns(){
        $this->customRawColumns = ['name', 'action'];
    }
}