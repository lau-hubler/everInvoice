<?php

namespace App\Http\Controllers;

use App\Http\Requests\StakeholderRequest;
use App\Stakeholder;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class StakeholderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Stakeholder[]|Collection|Response
     */
    public function index()
    {
        $stakeholders = Stakeholder::with('documentType')->get();

        if (request()->wantsJson()) {
            return $stakeholders;
        }

        return response()->view('models.stakeholder', compact('stakeholders'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StakeholderRequest $request
     * @return Builder|Builder[]|Collection|Model|Response
     */
    public function store(StakeholderRequest $request)
    {
        $stakeholder = Stakeholder::create($request->validated());

        return Stakeholder::with('documentType')->find($stakeholder->id);
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
     * @param Request $request
     * @param Stakeholder $stakeholder
     * @return Builder|Builder[]|Collection|Model|Response
     */
    public function update(StakeholderRequest $request, Stakeholder $stakeholder)
    {
        $stakeholder->update($request->validated());

        return Stakeholder::with('documentType')->find($stakeholder->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Stakeholder $stakeholder
     * @return Response
     */
    public function destroy(Stakeholder $stakeholder)
    {
        $stakeholder->delete();
    }
}
