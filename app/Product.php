<?php

namespace App;

use App\Concerns\ColumnFillable;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use ColumnFillable;

    public function category()
    {
        return $this->belongsTo(Category::class)->withDefault();
    }
}
