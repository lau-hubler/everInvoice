<?php

namespace App;

use App\Concerns\ColumnFillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @method static create(array $validated)
 */
class Category extends Model
{
    use ColumnFillable;
    use SoftDeletes;
}
