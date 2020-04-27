<?php

declare(strict_types=1);

namespace App;

use App\Concerns\ColumnFillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use ColumnFillable;
    use SoftDeletes;

    public function category()
    {
        return $this->belongsTo(Category::class)->withDefault();
    }

    public function invoices()
    {
        return $this->belongsToMany(Invoice::class)->using(Order::class);
    }

    public function scopeWithCategory($query)
    {
        return $query->with('category');
    }
}
