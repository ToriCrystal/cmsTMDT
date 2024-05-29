<?php

namespace App\Listeners;

use App\Events\UserDriverCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\Rates;

class UpdateRates
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\UserDriverCreated  $event
     * @return void
     */
    public function handle(UserDriverCreated $event)
    {
        // Lấy thông tin của tài xế vừa được tạo
        $userDriver = $event->userDriver;

        // Tạo bản ghi mới trong bảng Rates
        Rates::create([
            'user_id' => $userDriver->id,
        ]);
    }
}
