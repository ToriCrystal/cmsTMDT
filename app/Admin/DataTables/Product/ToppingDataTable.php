<?php

namespace App\Admin\DataTables\Product;

use App\Admin\DataTables\BaseDataTable;
use App\Admin\Repositories\Product\ToppingRepositoryInterface;
use App\Enums\Product\Type;

class ToppingDataTable extends BaseDataTable
{

    protected $nameTable = 'toppingTable';

    public function __construct(
        ToppingRepositoryInterface $repository
    ){
        $this->repository = $repository;

        parent::__construct();

    }

    public function setView(){
        $this->view = [
            'action' => 'stores.toppings.datatable.action',
            'edit_link' => 'stores.toppings.datatable.edit-link',        
            'type' => 'stores.toppings.datatable.type',
            'obligatory' => 'stores.toppings.datatable.obligatory',
        ];
    }

    public function setColumnSearch(){

        $this->columnAllSearch = [0,1];

        $this->columnSearchSelect = [
            [
                'column' => 1,
                'data' => Type::asSelectArray()
            ]
        ];

    }

    /**
     * Get query source of dataTable.
     *return $this->repository->getByQueryBuilder(['store_id' => $this->slider->id]); items
     * @param \App\Models\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        return $this->repository->getQueryBuilder();
    }

    protected function setCustomColumns(){
        $this->customColumns = config('datatables_columns.topping', []);
    }

    protected function setCustomEditColumns(){
        $this->customEditColumns = [
            'name' => $this->view['edit_link'],
            'created_at' => '{{ format_date($created_at) }}',
            'type' => $this->view['type'],
            'obligatory' => $this->view['obligatory'],
        ];
    }

    protected function setCustomAddColumns(){
        $this->customAddColumns = [
            'action' => $this->view['action'],
        ];
    }

    protected function setCustomRawColumns(){
        $this->customRawColumns = ['action','type','obligatory','name'];
    }
}

