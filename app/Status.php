<?php

namespace App;

use App\Concerns\ColumnFillable;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    use ColumnFillable;

    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }
}
