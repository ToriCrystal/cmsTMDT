<?php

namespace App\Admin\Http\Controllers\Product;

use App\Admin\DataTables\Product\ProductDataTable;
use App\Admin\Http\Controllers\Controller;
use App\Admin\Http\Requests\Product\ProductRequest;
use App\Admin\Repositories\Product\ProductRepositoryInterface;
use App\Admin\Repositories\Store\StoreRepositoryInterface;
use App\Admin\Repositories\StoreCategory\StoreCategoryRepositoryInterface;
use App\Admin\Services\Product\ProductServiceInterface;
use App\Enums\DefaultStatus;
use App\Enums\Product\StockStatus;

class ProductController extends Controller
{
    private StoreCategoryRepositoryInterface $storeCategoryRepository;
    private StoreRepositoryInterface $storeProductRepository;

    public function __construct(
        ProductRepositoryInterface       $repository,
        ProductServiceInterface          $service,
        StoreCategoryRepositoryInterface $storeCategoryRepository,
        StoreRepositoryInterface         $storeProductRepository
    )
    {

        parent::__construct();

        $this->repository = $repository;
        $this->service = $service;
        $this->storeCategoryRepository = $storeCategoryRepository;
        $this->storeProductRepository = $storeProductRepository;
    }

    public function getView()
    {

        return [
            'index' => 'admin.products.index',
            'create' => 'admin.products.create',
            'edit' => 'admin.products.edit'
        ];
    }

    public function getRoute()
    {

        return [
            'index' => 'admin.product.index',
            'create' => 'admin.product.create',
            'edit' => 'admin.product.edit',
            'delete' => 'admin.product.delete',
            'store' => 'admin.store.index'
        ];
    }

    public function index($storeId, ProductDataTable $dataTable)
    {
        $dataTable->setStoreId($storeId);
        return $dataTable->render($this->view['index'], [
            'breadcrums' => $this->crums->add(__('store'),
                route($this->route['store']))->add(__('product'))
        ]);
    }

    public function create()
    {

        $categories = $this->storeCategoryRepository->getAll();
        $stores = $this->storeProductRepository->getAll();
        return view($this->view['create'], [
            'stocks' => StockStatus::asSelectArray(),
            'status' => DefaultStatus::asSelectArray(),
            'stores' => $stores,
            'categories' => $categories,
        ]);
    }

    public function store(ProductRequest $request)
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

        $product = $this->repository->findOrFail($id);
        $storeId = $product->store_id;
        $categories = $this->storeCategoryRepository->getAll();
        $stores = $this->storeProductRepository->getAll();

        return view(
            $this->view['edit'],
            [
                'product' => $product,
                'stocks' => StockStatus::asSelectArray(),
                'status' => DefaultStatus::asSelectArray(),
                'stores' => $stores,
                'categories' => $categories,
                'breadcrums' => $this->crums->add(__('product'),
                    route($this->route['index'], ['id' => $storeId]))->add(__('edit'))
            ],
        );
    }

    public function update(ProductRequest $request)
    {

        $response = $this->service->update($request);

        if ($response) {
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
