<?php

namespace App;

use App\Concerns\ColumnFillable;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static create(array $validated)
 */
class Category extends Model
{
    use ColumnFillable;
}
