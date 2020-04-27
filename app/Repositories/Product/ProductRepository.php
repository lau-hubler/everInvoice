<?php


namespace App\Repositories\Product;

use App\Product;

class ProductRepository implements ProductRepositoryInterface
{
    protected $product;

    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    public function all()
    {
        return $this->product->withCategory()->get();
    }

    public function paginate($perPage = 10)
    {
        return $this->product->paginate($perPage);
    }

    public function find(int $id)
    {
        return $this->product->withCategory()->find($id);
    }
}
