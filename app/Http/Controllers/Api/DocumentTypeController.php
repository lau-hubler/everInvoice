<?php

namespace App\Http\Controllers\Api;

use App\DocumentType;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Response;

class DocumentTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return DocumentType[]|Collection|Response
     */
    public function all()
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
