<?php

namespace App\Store\Http\Controllers\Discount;

use App\Admin\Http\Controllers\Controller;
use App\Admin\Http\Requests\Store\Discount\DiscountRequests;
use App\Admin\Repositories\Discount\DiscountRepository;
use App\Admin\DataTables\Discount\DiscountDataTable;
use App\Admin\Services\Discount\DiscountService;
use Illuminate\Http\Request;


class DiscountController extends Controller
{

    // public function __construct(
    //     // DiscountRepositoryInterface $repository,
    //     DiscountServiceInterface $service
    // ){

    //     parent::__construct();
    //     // $this->repository = $repository;
    //     $this->service = $service;
    // }
    public function __construct(
        DiscountRepository $repository,
        DiscountService $service
    ){

        parent::__construct();
        $this->repository = $repository;
        $this->service = $service;
    }

    public function getView(){

        return [
            'index' => 'stores.discounts.index',
            'create' => 'stores.discounts.create',
            'edit' => 'stores.discounts.edit'
        ];
    }

    public function getRoute(){

        return [
            'index' => 'store.discount.index',
            'create' => 'store.discount.create',
            'edit' => 'store.discount.edit',
            'delete' => 'store.discount.delete'
        ];
    }

    public function index(DiscountDataTable $dataTable){
        return $dataTable->render($this->view['index'], [
            'breadcrums' => $this->crums->add(__('listdiscount'))
        ]);

    }

    public function create(){

        return view($this->view['create'], [
            'breadcrums' => $this->crums->add(__('listdiscount'), route($this->route['index']))->add(__('add')),
        ]);
    }



    public function store(DiscountRequests $request){

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

    public function update(DiscountRequests $request){

        $response = $this->service->update($request);

        if($response){
            return $request->input('submitter') == 'save'
                    ? back()->with('success', __('notifySuccess'))
                    : to_route($this->route['index'])->with('success', __('notifySuccess'));
        }

        return back()->with('error', __('notifyFail'));
    }

    public function delete($id){

        $this->service->delete($id);

        return to_route($this->route['index'])->with('success', __('notifySuccess'));
    }

}
