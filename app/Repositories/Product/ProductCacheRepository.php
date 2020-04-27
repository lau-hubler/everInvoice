<?php


namespace App\Repositories\Product;

use App\Product;
use Illuminate\Cache\CacheManager;

class ProductCacheRepository implements ProductRepositoryInterface
{
    protected $repo;

    protected $cache;

    const TTL = 1440; # 1 day

    public function __construct(CacheManager $cache, ProductRepository $repo)
    {
        $this->repo = $repo;
        $this->cache = $cache;
    }

    public function all()
    {
        return $this->cache->remember('products', env('CACHE_TTL', self::TTL), function () {
            return $this->repo->all();
        });
    }

    public function paginate()
    {
        return $this->cache->remember('products.pag', env('CACHE_TTL', self::TTL), function () {
            return $this->repo->paginate();
        });
    }

    public function find(int $id)
    {
        return $this->cache->remember('products.'.$id, env('CACHE_TTL', self::TTL), function () use ($id) {
            return $this->repo->find($id);
        });
    }
}
