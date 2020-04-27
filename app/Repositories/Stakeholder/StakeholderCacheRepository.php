<?php


namespace App\Repositories\Stakeholder;

use Illuminate\Cache\CacheManager;

class StakeholderCacheRepository implements StakeholderRepositoryInterface
{
    protected $repo;

    protected $cache;

    const TTL = 1440; # 1 day

    public function __construct(CacheManager $cache, StakeholderRepository $repo)
    {
        $this->repo = $repo;
        $this->cache = $cache;
    }

    public function all()
    {
        return $this->cache->remember('stakeholders', env('CACHE_TTL', self::TTL), function () {
            return $this->repo->all();
        });
    }

    public function paginate()
    {
        return $this->cache->remember('stakeholders.pag', env('CACHE_TTL', self::TTL), function () {
            return $this->repo->paginate();
        });
    }

    public function find($id)
    {
        return $this->cache->remember('stakeholders.' . $id, env('CACHE_TTL', self::TTL), function () use ($id) {
            return $this->repo->find($id);
        });
    }
}
