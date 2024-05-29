<?php

namespace App\Events;
use App\Models\Order;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
class NewOrderCreated
{
    use Dispatchable, SerializesModels;


    public $order;

    public function __construct(Order $order)
    {
        $this->order = $order;
    }

}
