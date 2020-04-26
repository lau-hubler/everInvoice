<?php


namespace App\Repositories\Stakeholder;


interface StakeholderRepositoryInterface
{
    public function all();

    public function paginate();

    public function find($id);

}
