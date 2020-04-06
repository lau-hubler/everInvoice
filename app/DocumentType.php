<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class DocumentType extends Model
{
    public function stakeholders(): HasMany
    {
        return $this->hasMany(Stakeholder::class);
    }
}
