<?php

namespace App\Admin\Services\Discount;

use App\Admin\Services\Discount\ProductService;
use  App\Admin\Repositories\Discount\DiscountRepository;
use App\Models\DiscountCodesProduct;
use Illuminate\Http\Request;


class DiscountService implements DiscountServiceInterface
{
    /**
     * Current Object instance
     *
     * @var array
     */
    protected $data;
    
    protected $repository;

    public function __construct(DiscountRepository $repository){
        $this->repository = $repository;
    }
    
    public function store(Request $request){
        $Data=$request->product_id;
        $this->data = $request->validated();
        $discount=$this->repository->create($this->data);
        if ($discount) {
            foreach($Data as $key => $item){
                $discountCodeProduct = new DiscountCodesProduct();
                $discountCodeProduct->discount_code_id = $discount->id;
                $discountCodeProduct->product_id = $item;
                $discountCodeProduct->save();
            }
        }
        return $discount;
    }

    public function update(Request $request){
        
        
        $this->data = $request->validated();

        $post = $this->repository->update($this->data['id'], $this->data);

        return $post;

    }

    public function delete($id){
        $discountCodeProduct = DiscountCodesProduct::where('discount_code_id', $id)->get();
        if($discountCodeProduct){
            DiscountCodesProduct::where('discount_code_id', $id)->delete();
        }
        return $this->repository->delete($id);

    }

}