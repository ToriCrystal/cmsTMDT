<?php

namespace App\Admin\Services\Product;

use  App\Admin\Repositories\Page\PageRepositoryInterface;
use App\Admin\Repositories\Product\ToppingRepositoryInterface;
use App\Models\Topping;
use Illuminate\Http\Request;


class ToppingService implements ToppingServiceInterface
{
    /**
     * Current Object instance
     *
     * @var array
     */
    protected $data;

    protected $repository;

    public function __construct(ToppingRepositoryInterface $repository){
        $this->repository = $repository;
    }

    public function store(Request $request){

        $obligatory = $request->filled('obligatory') ? 0 : 1;
        $this->data = $request->validated();
        $this->data['obligatory'] = $obligatory;
        $product = $this->repository->create($this->data);

        return $product;
    }

    public function update(Request $request){
        $obligatory = $request->filled('obligatory') ? 0 : 1;
        $this->data = $request->validated();
        $this->data['obligatory'] = $obligatory;
        $product = $this->repository->update($this->data['id'], $this->data);
        return $product;
    }

    public function delete($id){
        return $this->repository->delete($id);
    }
    public function counttopping($id){
        $result = Topping::where('store_id',$id)->get();
        return $result;
    }

}
