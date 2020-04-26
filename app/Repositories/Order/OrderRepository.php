<?php


namespace App\Repositories\Order;


use App\Order;

class OrderRepository implements OrderRepositoryInterface
{
    private $order;

    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    public function all()
    {
        return $this->order->get();
    }

    public function find($id)
    {
        return $this->order->find($id);
    }
}
