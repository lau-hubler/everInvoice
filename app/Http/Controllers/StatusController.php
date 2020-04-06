<?php

namespace App\Http\Controllers;

use App\Status;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class StatusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Status[]|Collection
     */
    public function index()
    {
        return Status::all();
    }

    /**
     * Display the specified resource.
     *
     * @param Status $status
     * @return Status|Response
     */
    public function show(Status $status)
    {
        return $status;
    }
}
