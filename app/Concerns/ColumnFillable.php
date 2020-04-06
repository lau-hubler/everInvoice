<?php

declare(strict_types=1);

namespace App\Concerns;

use Illuminate\Support\Facades\Schema;

trait ColumnFillable
{
    public function getFillable()
    {
        return Schema::getColumnListing($this->getTable());
    }
}
