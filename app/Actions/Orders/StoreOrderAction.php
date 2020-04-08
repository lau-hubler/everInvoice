<?php


namespace App\Actions\Orders;

use App\Actions\Action;
use App\Order;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class StoreOrderAction extends Action
{
    public function storeModel(Model $order, Request $data): Model
    {
        $order->invoice_id = $data->input('invoice_id');
        $order->product_id = $data->input('product_id');
        $order->quantity = $data->input('quantity');
        $order->unit_price = $data->input('unit_price');
        $order->product_iva = $data->input('product_iva');

        $order->save();

        return Order::with('product.category')->find($order->id);
    }
}
