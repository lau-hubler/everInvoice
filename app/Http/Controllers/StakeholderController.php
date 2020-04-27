<?php

namespace App\Http\Controllers;

use App\Stakeholder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;

class StakeholderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Stakeholder[]|Collection|Response
     */
    public function index()
    {
        Gate::authorize('viewAny', Stakeholder::class);

        return response()->view('stakeholder.index');
    }
}
