<?php

namespace App\Http\Controllers;

use App\Stakeholder;
use Illuminate\Http\Request;

class StakeholderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Stakeholder[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Http\Response
     */
    public function index()
    {
        $stakeholders = Stakeholder::with('documentType')->get();

        if (request()->wantsJson()) {
            return $stakeholders;
        }

        return response()->view('models.stakeholder.index', compact('stakeholders'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|\Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $stakeholder = new Stakeholder();
        $stakeholder->name = $request->name;
        $stakeholder->surname = $request->surname;
        $stakeholder->company = $request->company;
        $stakeholder->is_company = $request->is_company;
        $stakeholder->document_type_id = $request->document_type_id;
        $stakeholder->document = $request->document;
        $stakeholder->email = $request->email;
        $stakeholder->mobile = $request->mobile;
        $stakeholder->save();

        return Stakeholder::with('documentType')->find($stakeholder->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Stakeholder  $stakeholder
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|\Illuminate\Http\Response
     */
    public function show(Stakeholder $stakeholder)
    {
        return Stakeholder::with('documentType')->find($stakeholder->id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Stakeholder  $stakeholder
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|\Illuminate\Http\Response
     */
    public function update(Request $request, Stakeholder $stakeholder)
    {
        $stakeholder->name = $request->name;
        $stakeholder->surname = $request->surname;
        $stakeholder->company = $request->company;
        $stakeholder->is_company = $request->is_company;
        $stakeholder->document_type_id = $request->document_type_id;
        $stakeholder->document = $request->document;
        $stakeholder->email = $request->email;
        $stakeholder->mobile = $request->mobile;
        $stakeholder->save();

        return Stakeholder::with('documentType')->find($stakeholder->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Stakeholder  $stakeholder
     * @return \Illuminate\Http\Response
     */
    public function destroy(Stakeholder $stakeholder)
    {
        $stakeholder->delete();
    }
}
