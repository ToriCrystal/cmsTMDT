<?php

namespace App\Admin\DataTables\Store;

use App\Admin\DataTables\BaseDataTable;
use App\Admin\Repositories\Store\StorePrioritieRepositoryInterface;
use App\Enums\Prioritize\Prioritize;

class StorePrioritieDataTable extends BaseDataTable
{

    protected $nameTable = 'storeprioritieTable';

    public function __construct(
        StorePrioritieRepositoryInterface $repository
    ){
        $this->repository = $repository;
        
        parent::__construct();
    }

    public function setView(){
        $this->view = [
            'action' => 'admin.prioritie.datatable.action',
            'status' => 'admin.prioritie.datatable.status',
            'storename' => 'admin.prioritie.datatable.store-name',
        ];
    }

    public function setColumnSearch(){

        $this->columnAllSearch = [3];

        $this->columnSearchDate = [3];
        
        
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
        $this->customColumns = config('datatables_columns.prioritie', []);
    }

    protected function setCustomEditColumns(){
        $this->customEditColumns = [
            'day' => '{{$day}} Ngày',
            // 'status' => $this->view['status'],
            'created_at' => '{{ format_date($created_at) }}',
            'total' => '{{ format_price($total) }}',
            'store_id' => function ($order) {
                return view($this->view['storename'],
                    [
                        'store_name' => $order->customer->store_name,
                        'id' => $order->store_id,
                    ]
                )->render();
            },
            
        ];
    }

    protected function setCustomAddColumns(){
        $this->customAddColumns = [
            'action' => $this->view['action'],
        ];
    }

    protected function setCustomRawColumns(){
        $this->customRawColumns = ['action'];
    }
}