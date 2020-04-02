<?php

namespace App;

use App\Concerns\ColumnFillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Stakeholder extends Model
{
    use ColumnFillable;
    use SoftDeletes;

    public function documentType()
    {
        return $this->belongsTo(DocumentType::class);
    }
}
