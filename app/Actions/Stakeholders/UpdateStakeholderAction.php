<?php


namespace App\Actions\Stakeholders;

use App\Actions\Action;
use App\Stakeholder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class UpdateStakeholderAction extends Action
{
    public function storeModel(Model $stakeholder, Request $data): Model
    {
        $stakeholder->update($data->validated());

        return Stakeholder::with('documentType')->find($stakeholder->id);
    }
}
