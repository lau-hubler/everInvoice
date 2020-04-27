<?php


namespace App\Repositories\Product;

interface ProductRepositoryInterface
{
    public function all();

    public function paginate();

    public function find(int $id);
}
