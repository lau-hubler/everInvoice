<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderRequest;
use App\Order;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Builder[]|Collection|Response
     */
    public function index()
    {
        return Order::with('product.iva')->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param OrderRequest $request
     * @return Builder|Builder[]|Collection|Model|Response
     */
    public function store(OrderRequest $request)
    {
        $order = Order::create($request->validated());

        return Order::with('product.category')->find($order->id);
    }

    /**
     * Display the specified resource.
     *
     * @param Order $order
     * @return Builder|Builder[]|Collection|Model|Response
     */
    public function show(Order $order)
    {
        return Order::with('product.iva')->find($order->id);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param OrderRequest $request
     * @param Order $order
     * @return Builder|Builder[]|Collection|Model|Response
     */
    public function update(OrderRequest $request, Order $order)
    {
        $order->update($request->validated());

        return Order::with('product.category')->find($order->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Order $order
     * @return void
     * @throws Exception
     */
    public function destroy(Order $order): void
    {
        $order->delete();
    }
}
