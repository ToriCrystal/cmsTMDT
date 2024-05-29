<?php

namespace App\Store\Http\Controllers\Order;

use App\Admin\Http\Controllers\Controller;
use App\Admin\Repositories\Order\OrderRepositoryInterface;
use App\Admin\DataTables\Order\OrderStoreItemDataTable;
use App\Admin\Repositories\User\UserRepositoryInterface;
use App\Admin\Http\Requests\Order\OrderRequest;



class OrderItemController extends Controller
{
    protected $repositoryOrder;
    protected $repositoryUser;
    public function __construct(
        UserRepositoryInterface $repositoryUser,
        OrderRepositoryInterface $repositoryOrder,
    ){

        parent::__construct();
        $this->repositoryOrder = $repositoryOrder;
        $this->repositoryUser = $repositoryUser;
    }

    public function getView(){

        return [
            'index' => 'stores.orders.items.index',
            'create' => 'stores.orders.create',
            'edit' => 'stores.orders.edit'
        ];
    }

    public function getRoute(){

        return [
            'index_slider' => 'store.order.index',
            'index' => 'store.order.item.index',
            'create' => 'store.order.item.create',
            'edit' => 'store.order.item.edit',
            'delete' => 'store.order.item.delete'
        ];
    }

    public function index($id,OrderStoreItemDataTable $dataTable){
        $order = $this->repositoryOrder->findOrFail($id);
        $user = $this->repositoryUser->findOrFail( $order->customer_id);
        return $dataTable->with('order', $order)->render($this->view['index'], [
            'order' => $order,
            'user'=>$user,
            'breadcrums' => $this->crums->add(__('danh sách ĐH'), route($this->route['index_slider']))->add(__('Thông tin chi tiết đơn hàng'))
        ]);
        

    }


    public function store(OrderRequest $request){

        $response = $this->service->store($request);

        if($response){
            return $request->input('submitter') == 'save'
                    ? to_route($this->route['edit'], $response->id)->with('success', __('notifySuccess'))
                    : to_route($this->route['index'])->with('success', __('notifySuccess'));
        }

        return back()->with('error', __('notifyFail'))->withInput();
    }

    public function edit($id){

        $page = $this->repository->findOrFail($id);
        return view(
            $this->view['edit'],
            [
                'page' => $page,
                'breadcrums' => $this->crums->add(__('Sửa mã giảm giá'), route($this->route['index']))->add(__('edit'))
            ],
        );
    }

    // public function update(DiscountRequests $request){

    //     $response = $this->service->update($request);

    //     if($response){
    //         return $request->input('submitter') == 'save'
    //                 ? back()->with('success', __('notifySuccess'))
    //                 : to_route($this->route['index'])->with('success', __('notifySuccess'));
    //     }

    //     return back()->with('error', __('notifyFail'));
    // }

    // public function delete($id){

    //     $this->service->delete($id);

    //     return to_route($this->route['index'])->with('success', __('notifySuccess'));
    // }

}
