<?php

namespace App\Http\Controllers\Api;

use App\Actions\Stakeholders\StoreStakeholderAction;
use App\Actions\Stakeholders\UpdateStakeholderAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\StakeholderRequest;
use App\Stakeholder;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Response;

class StakeholderController extends Controller
{
    /**
     * Add policy to controller.
     */
    public function __construct()
    {
        $this->authorizeResource(Stakeholder::class, 'stakeholder');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Builder[]|Collection|Response
     */
    public function index()
    {
        return Stakeholder::with('documentType')->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StakeholderRequest $request
     * @param Stakeholder $stakeholder
     * @param StoreStakeholderAction $action
     * @return Model|Response
     */
    public function store(StakeholderRequest $request, Stakeholder $stakeholder, StoreStakeholderAction $action)
    {
        return $action->execute($stakeholder, $request);
    }

    /**
     * Display the specified resource.
     *
     * @param Stakeholder $stakeholder
     * @return Builder|Builder[]|Collection|Model|Response
     */
    public function show(Stakeholder $stakeholder)
    {
        return Stakeholder::with('documentType')->find($stakeholder->id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param StakeholderRequest $request
     * @param Stakeholder $stakeholder
     * @param UpdateStakeholderAction $action
     * @return Model|Response
     */
    public function update(StakeholderRequest $request, Stakeholder $stakeholder, UpdateStakeholderAction $action)
    {
        return $action->execute($stakeholder, $request);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Stakeholder $stakeholder
     * @return array|Response|string
     * @throws Exception
     */
    public function destroy(Stakeholder $stakeholder)
    {
        $stakeholder->delete();

        return __('This stakeholder was successfully deleted');
    }
}
