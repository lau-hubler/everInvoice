<?php


namespace App\Actions\Orders;

use App\Actions\Action;
use App\Order;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class UpdateOrderAction extends Action
{
    public function storeModel(Model $order, Request $data): Model
    {
        $order->update($data->validated());

        return Order::with('product.category')->find($order->id);
    }
}
