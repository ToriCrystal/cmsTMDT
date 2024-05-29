<?php

namespace App\Api\V1\Repositories\Product;
use App\Admin\Repositories\EloquentRepositoryInterface;

interface ProductRepositoryInterface extends EloquentRepositoryInterface
{
    public function findByIdWithAncestorsAndDescendants($id);
    public function getTree();
    public function searchAllLimit($value = '', $meta = [], $limit = 10);
}
