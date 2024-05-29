<?php

namespace App\Admin\DataTables\Order;

use App\Admin\DataTables\BaseDataTable;
use App\Admin\Repositories\Order\OrderRepositoryInterface;
use App\Enums\Order\OrderStatus;


class OrderStoreDataTable extends BaseDataTable
{

    protected $nameTable = 'orderTable';

    public function __construct(
        OrderRepositoryInterface $repository
    )
    {
        $this->repository = $repository;

        parent::__construct();
    }

    public function setView()
    {
        $this->view = [
            'action' => 'stores.orders.datatable.action',
            'code' => 'stores.orders.datatable.code',
            'status' => 'stores.orders.datatable.status',
            'customer' => 'stores.orders.datatable.customer',
            'driver' => 'stores.orders.datatable.driver',
            'items' => 'stores.orders.datatable.items',

        ];
    }

    public function setColumnSearch()
    {

        $this->columnAllSearch = [0,3,4];

        $this->columnSearchDate = [4];

        $this->columnSearchSelect = [
            [
                'column' => 3,
                'data' => OrderStatus::asSelectArray()
            ],

        ];
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Order $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        return $this->repository->getByQueryBuilder(['store_id' => $this->id]);
    }

    protected function setCustomColumns()
    {
        $this->customColumns = config('datatables_columns.orderstore', []);
    }

    protected function setCustomEditColumns()
    {
        $this->customEditColumns = [
            'code' => $this->view['code'],
            'created_at' => '{{ format_date($created_at) }}',
            'system_revenue' => '{{ format_price($system_revenue) }}',
            'transport_fee' => '{{ format_price($transport_fee) }}',
            'status' => $this->view['status'],
            'customer_id' => function ($order) {
                return view($this->view['customer'],
                    [
                        'customer_name' => $order->customer->fullname,
                        'customer_id' => $order->customer_id,
                    ]
                )->render();
            },
            'driver_id' => function ($order) {
                $driverName = $order->driver && $order->driver->user ? $order->driver->user->fullname : 'N/A';
                return view($this->view['driver'], [
                    'driver_name' => $driverName,
                    'driver_id' => $order->driver_id,
                ])->render();
            },
            'items' => $this->view['items'],

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
        $this->customRawColumns = ['code', 'action', 'status','customer_id', 'driver_id','items'];
    }

    public function setCustomFilterColumns()
    {
        $this->customFilterColumns = [

        ];
    }
}
