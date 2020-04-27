<?php


namespace App\Repositories\Order;


use Illuminate\Cache\CacheManager;

class OrderCacheRepository implements OrderRepositoryInterface
{
    protected $repo;

    protected $cache;

    const TTL = 1440; # 1 day

    public function __construct(CacheManager $cache, OrderRepository $repo) {
        $this->repo = $repo;
        $this->cache = $cache;
    }

    public function all()
    {
        return $this->cache->remember('orders', env('CACHE_TTL', self::TTL), function () {
            return $this->repo->all();
        });
    }

    public function find($id)
    {
        return $this->cache->remember('orders.'.$id, env('CACHE_TTL', self::TTL), function () use ($id) {
            return $this->repo->find($id);
        });
    }
}
