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

        return response()->view('stakeholder.index', compact('stakeholders'));
    }
}
