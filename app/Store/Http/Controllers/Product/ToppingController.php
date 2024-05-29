<?php

namespace App\Store\Http\Controllers\Product;

use App\Admin\Http\Controllers\Controller;
use App\Admin\Http\Requests\Product\ToppingRequest;
use App\Admin\Repositories\Product\ProductRepositoryInterface;
use App\Admin\Repositories\Product\ToppingRepositoryInterface;
use App\Admin\DataTables\Product\ToppingDataTable;
use App\Admin\Services\Product\ToppingServiceInterface;
use App\Enums\DefaultStatus;
use App\Enums\Product\StockStatus;
use App\Admin\Repositories\StoreCategory\StoreCategoryRepositoryInterface;



class ToppingController extends Controller
{
    protected $repositorySlider;
    public function __construct(
        ToppingRepositoryInterface $repository,
        ToppingServiceInterface $service,
    ) {
        parent::__construct();

        $this->repository = $repository;
        $this->service = $service;
    }

    public function getView(){

        return [
            'index' => 'stores.toppings.index',
            'create' => 'stores.toppings.create',
            'edit' => 'stores.toppings.edit'
        ];
    }

    public function getRoute(){

        return [
            'index' => 'store.topping.index',
            'create' => 'store.topping.create',
            'edit' => 'store.topping.edit',
            'delete' => 'store.topping.delete'
        ];
    }
    public function index(ToppingDataTable $dataTable){
        
        return $dataTable->render($this->view['index'], [

            'breadcrums' => $this->crums->add(__('listtopping'), route($this->route['index']))
        ]);

    }

    public function create(){
        $store_id = auth('store')->user();
        $counttopping = $this->service->counttopping($store_id->id);
        if (count($counttopping)<= 100){
            return view($this->view['create'], [
                'breadcrums' => $this->crums->add(__('listtopping'), route($this->route['index']))->add(__('add')),
                'store_id'=>$store_id,
            ]);
        }else{
            return to_route($this->route['index'])->with('warning', __('Bạn đã đủ 100 topping'));
        }
        
    }

    public function store(ToppingRequest $request){
        $response = $this->service->store($request);

        if($response){
            return $request->input('submitter') == 'save'
                    ? to_route($this->route['edit'], $response->id)->with('success', __('notifySuccess'))
                    : to_route($this->route['index'])->with('success', __('notifySuccess'));
        }

        return back()->with('error', __('notifyFail'))->withInput();
    }

    public function edit($id){
        $store_id = auth('store')->user();
        $page = $this->repository->findOrFail($id);
        return view(
            $this->view['edit'],
            [
                'store_id'=>$store_id,
                'page' => $page,
                'breadcrums' => $this->crums->add(__('topping'), route($this->route['index']))->add(__('edit')),
            ],
        );
    }

    public function update(ToppingRequest $request){

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
