<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Stakeholder extends Model
{
    use SoftDeletes;

    public function documentType()
    {
        return $this->belongsTo(DocumentType::class);
    }
}
