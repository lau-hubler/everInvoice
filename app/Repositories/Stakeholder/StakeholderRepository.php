<?php


namespace App\Repositories\Stakeholder;

use App\Stakeholder;

class StakeholderRepository implements StakeholderRepositoryInterface
{
    private $stakeholder;

    public function __construct(Stakeholder $stakeholder)
    {
        $this->stakeholder = $stakeholder;
    }

    public function all()
    {
        return $this->stakeholder->withDocumentType()->get();
    }

    public function paginate()
    {
        return $this->stakeholder->withDocumentType()->paginate();
    }

    public function find($id)
    {
        return $this->stakeholder->withDocumentType()->find($id);
    }
}
