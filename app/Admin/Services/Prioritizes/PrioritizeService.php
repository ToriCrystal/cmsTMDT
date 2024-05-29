<?php

namespace App\Admin\Services\Prioritizes;

use App\Admin\Repositories\Prioritizes\PrioritizeRepositoryInterface;
use Illuminate\Http\Request;
use App\Enums\Prioritize\Prioritize;



class PrioritizeService implements PrioritizeServiceInterface
{
    /**
     * Current Object instance
     *
     * @var array
     */
    protected $data;

    protected $repository;

    public function __construct(PrioritizeRepositoryInterface $repository){
        $this->repository = $repository;
    }

    public function store(Request $request){
        $this->data = 
        ['store_id' => $request->store_id,
        'day' => $request->day,
        'total' => $request->total,
        'status' => Prioritize::Notprocessed,];
        $prioritize = $this->repository->create($this->data);

        return $prioritize;
    }

    public function update(Request $request){
        $this->data = $request->validated();
        $product = $this->repository->update($this->data['id'], $this->data);
        return $product;
    }

    public function delete($id){
        return $this->repository->delete($id);
    }



}
