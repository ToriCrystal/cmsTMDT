<?php

namespace App\Admin\Http\Controllers\Order;

use App\Admin\DataTables\Order\OrderDataTable;
use App\Admin\DataTables\Order\OrderDriverHistoryDataTable;
use App\Admin\Http\Controllers\Controller;
use App\Admin\Http\Requests\Order\OrderRequest;
use App\Admin\Repositories\Order\OrderItemRepositoryInterface;
use App\Admin\Repositories\Order\OrderRepositoryInterface;
use App\Admin\Services\Order\OrderServiceInterface;
use App\Enums\Driver\DriverAssignmentType;
use App\Enums\Order\OrderStatus;
use App\Enums\Payment\PaymentMethod;
use App\Enums\Shipping\ShippingMethod;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;

class OrderController extends Controller
{

    private OrderItemRepositoryInterface $orderItemRepository;

    public function __construct(
        OrderRepositoryInterface     $repository,
        OrderServiceInterface        $service,
        OrderItemRepositoryInterface $orderItemRepository
    )
    {

        parent::__construct();

        $this->repository = $repository;
        $this->service = $service;
        $this->orderItemRepository = $orderItemRepository;
    }

    public function getView(): array
    {

        return [
            'index' => 'admin.orders.index',
            'create' => 'admin.orders.create',
            'edit' => 'admin.orders.edit',
            'orderDriverHistory' => 'admin.orders.history',
        ];
    }

    public function getRoute(): array
    {

        return [
            'index' => 'admin.order.index',
            'create' => 'admin.area.create',
            'edit' => 'admin.order.edit',
            'delete' => 'admin.area.delete',
            'orderDriverHistory' => 'admin.order.orderDriverHistory'
        ];
    }

    public function index(OrderDataTable $dataTable)
    {

        return $dataTable->render($this->view['index'], [
            'breadcrums' => $this->crums->add(__('order'))
        ]);
    }

    public function orderDriverHistory($id, OrderDriverHistoryDataTable $dataTable)
    {
        return $dataTable->setUserId($id)->render($this->view['orderDriverHistory'], [
            'breadcrums' => $this->crums->add(__('user'),
                route($this->route['orderDriverHistory'], ['id' => $id]))->add(__('view_order_driver_history'))
        ]);
    }

    public function create()
    {

        return view($this->view['create'], [
            'breadcrums' => $this->crums->add(__('order'), route($this->route['index']))->add(__('add')),
            'status' => OrderStatus::asSelectArray(),
            'shipping' => ShippingMethod::asSelectArray(),
            'driver_assignment' => DriverAssignmentType::asSelectArray(),
            'payment' => PaymentMethod::asSelectArray(),
        ]);
    }

    public function getInfoOrder(OrderRequest $request): JsonResponse
    {
        return $this->service->getInformationOrder($request);
    }

    public function store(OrderRequest $request): RedirectResponse
    {

        $response = $this->service->store($request);

        if ($response) {
            return $request->input('submitter') == 'save'
                ? to_route($this->route['edit'], $response->id)->with('success', __('notifySuccess'))
                : to_route($this->route['index'])->with('success', __('notifySuccess'));
        }

        return back()->with('error', __('notifyFail'))->withInput();
    }

    public function edit($id)
    {

        $response = $this->repository->findOrFail($id);
        $orderItems = $this->orderItemRepository->getBy(['order_id' => $id]);

        return view(
            $this->view['edit'],
            [
                'order' => $response,
                'orderItems' => $orderItems,
                'status' => OrderStatus::asSelectArray(),
                'shipping' => ShippingMethod::asSelectArray(),
                'payment' => PaymentMethod::asSelectArray(),
                'breadcrums' => $this->crums->add(__('order'), route($this->route['index']))->add(__('edit'))
            ],
        );

    }


    public function update(OrderRequest $request)
    {

        $response = $this->service->update($request);

        if ($response) {
            // Gọi sự kiện OrderStatusUpdated
            event(new \App\Events\OrderStatusUpdated($response));

            return $request->input('submitter') == 'save'
                ? back()->with('success', __('notifySuccess'))
                : to_route($this->route['index'])->with('success', __('notifySuccess'));
        }

        return back()->with('error', __('notifyFail'));
    }

    public function delete($id)
    {

        $this->service->delete($id);

        return to_route($this->route['index'])->with('success', __('notifySuccess'));
    }
}
