<?php

namespace App\Api\V1\Services\Product;
use Illuminate\Http\Request;

interface ProductServiceInterface
{
    /**
     * Tạo mới
     *
     * @var Illuminate\Http\Request $request
     *
     * @return mixed
     */
    public function store(Request $request);
    /**
     * Cập nhật
     *
     * @var Illuminate\Http\Request $request
     *
     * @return boolean
     */
    public function update(Request $request);
    /**
     * Xóa
     *
     * @param int $id
     *
     * @return boolean
     */
    public function delete($id);

    public function getInstance();

    public function getByCategory(Request $request);

    public function getByStore(Request $request);

    public function searchProducts(Request $request);





}
