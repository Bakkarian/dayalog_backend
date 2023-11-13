<?php

namespace App\Services;

use App\Models\Order;

class OrderService
{
    public function store(array $data): Order
    {
        $order = Order::create($data);
        return $order;
    }

    public function update(array $data, Order $order): Order
    {
        $order->update($data);
        return $order;
    }

}
