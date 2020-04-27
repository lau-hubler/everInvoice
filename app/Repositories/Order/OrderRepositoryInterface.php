<?php


namespace App\Repositories\Order;

interface OrderRepositoryInterface
{
    public function all();

    public function find($id);
}
