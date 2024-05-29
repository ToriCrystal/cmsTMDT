<?php

namespace App\Admin\DataTables\Order;

use App\Admin\DataTables\BaseDataTable;
use App\Admin\Repositories\Order\OrderItemRepositoryInterface;



class OrderStoreItemDataTable extends BaseDataTable
{

    protected $nameTable = 'orderItemStoreTable';

    public function __construct(
        OrderItemRepositoryInterface $repository
    )
    {
        $this->repository = $repository;

        parent::__construct();
    }

    public function setView()
    {
        $this->view = [
            'action' => 'stores.orders.items.datatable.action',
            'customer' => 'stores.orders.items.datatable.customer',
            'product' => 'stores.orders.items.datatable.product',
        ];
    }

    public function setColumnSearch()
    {

        $this->columnAllSearch = [];

        // $this->columnSearchDate = [4];

        // $this->columnSearchSelect = [
        //     [
        //         'column' => 3,
        //         'data' => OrderStatus::asSelectArray()
        //     ],

        // ];
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Order $model
     * @return \Illuminate\Database\Eloquent\Builder
     *  return $this->repository->getByQueryBuilder(['order_id' => $this->order->id]);
     */
    public function query()
    {
       
        return $this->repository->getByQueryBuilder(['order_id' => $this->order->id]);
    }

    protected function setCustomColumns()
    {
        $this->customColumns = config('datatables_columns.orderitem', []);
    }

    protected function setCustomEditColumns()
    {
        $this->customEditColumns = [
            'unit_price' => '{{ format_price($unit_price) }}',
            'order_id' => function ($orderItem) {
                return view($this->view['customer'],
                    [
                        'order_code' => $orderItem->order->code,
                        'order_id' => $orderItem->order_id,
                    ]
                )->render();
            },
            'product_id' => function ($orderItem) {
                return view($this->view['product'],
                    [
                        'product_name' => $orderItem->product->name,
                        'product_id' => $orderItem->product_id,
                    ]
                )->render();
            },
        ];
    }

    protected function setCustomAddColumns()
    {
        $this->customAddColumns = [
            'action' => $this->view['action'],
        ];
    }
    //$this->customRawColumns = ['code', 'action', 'status', 'payment_method','customer_id', 'driver_id', 'shipping_method'];
    protected function setCustomRawColumns()
    {
        $this->customRawColumns = ['title', 'action','order_id','product_id'];
    }

    public function setCustomFilterColumns()
    {
        $this->customFilterColumns = [

        ];
    }
}
