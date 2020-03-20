<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @method static find(Category $category)
 */
class Category extends Model
{
    use SoftDeletes;
}
