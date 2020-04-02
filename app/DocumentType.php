<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DocumentType extends Model
{
    public function stakeholders()
    {
        return $this->hasMany(Stakeholder::class);
    }
}
