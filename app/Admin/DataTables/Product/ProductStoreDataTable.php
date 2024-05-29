<?php

namespace App\Admin\DataTables\Product;

use App\Admin\DataTables\BaseDataTable;
use App\Admin\Repositories\Product\ProductRepositoryInterface;
use App\Enums\Product\StockStatus;

class ProductStoreDataTable extends BaseDataTable
{

    protected $nameTable = 'productStoreTable';

    public function __construct(
        ProductRepositoryInterface $repository
    ){
        $this->repository = $repository;

        parent::__construct();

    }

    public function setView(){
        $this->view = [
            'action' => 'stores.products.datatable.action',
            'name' => 'stores.products.datatable.name',
            'checkbox' => 'stores.products.datatable.checkbox',
            'edit_link' => 'stores.products.datatable.edit-link',
            'in_stock' => 'stores.products.datatable.in_stock',
            'status' => 'stores.products.datatable.status',
        ];
    }

    public function setColumnSearch(){

        $this->columnAllSearch = [1,6];

        $this->columnSearchSelect = [
            [
                'column' => 6,
                'data' => StockStatus::asSelectArray()
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
        return $this->repository->getQueryBuilder();
    }

    protected function setCustomColumns(){
        $this->customColumns = config('datatables_columns.productstore', []);
    }

    protected function setCustomEditColumns(){
        $this->customEditColumns = [
            'name' => $this->view['edit_link'],
            'in_stock' => $this->view['in_stock'],
            'status' => $this->view['status'],
            'created_at' => '{{ format_date($created_at) }}',
            'price' => '{{ format_price($price) }}',
            'price_selling' => '{{ format_price($price_selling) }}',
            // 'items' => $this->view['items'],
        ];
    }

    protected function setCustomAddColumns(){
        $this->customAddColumns = [
            'action' => $this->view['action'],
            'checkbox' => $this->view['checkbox'],
        ];
    }

    protected function setCustomRawColumns(){
        $this->customRawColumns = ['name','action','checkbox','name','in_stock','status'];
    }
}

