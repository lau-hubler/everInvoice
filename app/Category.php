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

    public static function boot()
    {
        parent::boot();
        self::deleting(function ($category) {
            $category->products()->each(function ($product) {
                $product->update(['category_id' => 1]);
            });
        });
    }
}
