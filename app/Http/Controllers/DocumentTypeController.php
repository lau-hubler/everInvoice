<?php

namespace App\Http\Controllers;

use App\DocumentType;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class DocumentTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return DocumentType[]|Collection|Response
     */
    public function index()
    {
        return DocumentType::all();
    }

    /**
     * Display the specified resource.
     *
     * @param DocumentType $documentType
     * @return DocumentType|Response
     */
    public function show(DocumentType $documentType)
    {
        return $documentType;
    }
}
