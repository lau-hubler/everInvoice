<?php

declare(strict_types=1);

namespace App;

use App\Concerns\ColumnFillable;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static create(array $validated)
 */
class Category extends Model
{
    use ColumnFillable;

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
