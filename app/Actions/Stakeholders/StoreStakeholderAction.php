<?php


namespace App\Actions\Stakeholders;

use App\Actions\Action;
use App\Stakeholder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class StoreStakeholderAction extends Action
{
    public function storeModel(Model $stakeholder, Request $data): Model
    {
        $stakeholder->name = $data->input('name');
        $stakeholder->surname = $data->input('surname');
        $stakeholder->company = $data->input('company');
        $stakeholder->is_company = $data->input('is_company');
        $stakeholder->document_type_id = $data->input('document_type_id');
        $stakeholder->document = $data->input('document');
        $stakeholder->email = $data->input('email');
        $stakeholder->mobile = $data->input('mobile');

        $stakeholder->save();

        return Stakeholder::with('documentType')->find($stakeholder->id);
    }
}
