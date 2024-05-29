<?php

namespace App\Store\Http\Controllers\Product;

use App\Admin\Http\Controllers\Controller;
use App\Admin\Http\Requests\Product\ProductStoreRequest;
use App\Admin\Repositories\Product\ProductRepositoryInterface;
use App\Admin\DataTables\Product\ProductStoreDataTable;
use App\Admin\Services\Product\ProductServiceInterface;
use App\Enums\DefaultStatus;
use App\Enums\Product\StockStatus;
use App\Admin\Repositories\StoreCategory\StoreCategoryRepositoryInterface;



class ProductController extends Controller
{
    protected $repositoryCategory;
    protected $repoStoreCategory;
    private StoreCategoryRepositoryInterface $storeCategoryRepository;
    public function __construct(
        ProductRepositoryInterface $repository,
        StoreCategoryRepositoryInterface $repoStoreCategory,
        ProductServiceInterface $service,
        StoreCategoryRepositoryInterface $storeCategoryRepository,
    ){

        parent::__construct();
        $this->repoStoreCategory = $repoStoreCategory;
        $this->repository = $repository;
        $this->service = $service;
        $this->storeCategoryRepository = $storeCategoryRepository;
    }

    public function getView(){

        return [
            'index' => 'stores.products.index',
            'create' => 'stores.products.create',
            'edit' => 'stores.products.edit'
        ];
    }

    public function getRoute(){

        return [
            'index' => 'store.product.index',
            'create' => 'store.product.create',
            'edit' => 'store.product.edit',
            'delete' => 'store.product.delete'
        ];
    }
    public function index(ProductStoreDataTable $dataTable){

        return $dataTable->render($this->view['index'], [
            'breadcrums' => $this->crums->add(__('listproduct')),
            'status' => DefaultStatus::asSelectArray(),
        ]);

    }

    public function create(){
        $store_id = auth('store')->user();
        $StoreProductall = $this->service->getproduct($store_id->id);
        if (count($StoreProductall)<= 100){
            $categories = $this->storeCategoryRepository->getAll();
            return view($this->view['create'], [
                'breadcrums' => $this->crums->add(__('listproduct'), route($this->route['index']))->add(__('add')),
                'store_categories' => $categories,
                'store_id'=>$store_id,
                'status' => DefaultStatus::asSelectArray(),
                'stocks' => StockStatus::asSelectArray(),
            ]);
        }else{
            return to_route($this->route['index'])->with('warning', __('Bạn đã đủ 100 sp'));
        }

    }

    public function store(ProductStoreRequest $request){
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
        $categories = $this->storeCategoryRepository->getAll();

        return view(
            $this->view['edit'],
            [
                'store_id'=>$store_id,
                'store_categories' => $categories,
                'page' => $page,
                'breadcrums' => $this->crums->add(__('product'), route($this->route['index']))->add(__('edit')),
                'status' => DefaultStatus::asSelectArray(),
                'stocks' => StockStatus::asSelectArray(),
            ],
        );
    }

    public function update(ProductStoreRequest $request){

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
    public function draft($id){
        $this->service->draft($id);
        return to_route($this->route['index'])->with('success', __('đã đổi'));
    }
    public function allupload(){

    }
}
