<?php

namespace App\Admin\DataTables\Discount;

use App\Admin\DataTables\BaseDataTable;
use App\Admin\Repositories\Discount\DiscountRepository;
use App\Enums\DiscountType;

class DiscountDataTable extends BaseDataTable
{

    protected $nameTable = 'discountTable';

    public function __construct(
        DiscountRepository $repository
    ){
        $this->repository = $repository;

        parent::__construct();

    }

    public function setView(){
        $this->view = [
            'action' => 'stores.discounts.datatable.action',
            'title'=>'stores.discounts.datatable.title',
            'edit_link' => 'stores.discounts.datatable.edit-link',
            'type' => 'stores.discounts.datatable.type',
        ];
    }

    public function setColumnSearch(){

        $this->columnAllSearch = [0,5];

        $this->columnSearchSelect = [
            [
                'column' => 5,
                'data' => DiscountType::asSelectArray()
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
        return $this->repository->getQueryBuilderOrderBy();
    }

    protected function setCustomColumns(){
        $this->customColumns = config('datatables_columns.discount', []);
    }

    protected function setCustomEditColumns(){
        $this->customEditColumns = [
            
            'code' => $this->view['edit_link'],
            'type' => $this->view['type'],
            'date_start' => '{{ format_date($date_start) }}',
            'date_end' => '{{ format_date($date_end) }}',
            'min_order_amount' => '{{ format_price($min_order_amount) }}',
            'discount_value' => '{{ format_price($discount_value) }}',
        ];
    }

    protected function setCustomAddColumns(){
        $this->customAddColumns = [
            'action' => $this->view['action'],
        ];
    }

    protected function setCustomRawColumns(){
        $this->customRawColumns = ['code','action','type'];
    }
}