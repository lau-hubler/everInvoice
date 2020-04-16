<?php

namespace App;

use App\Concerns\ColumnFillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Transaction extends Model
{
    use ColumnFillable;

    public function status(): BelongsTo
    {
        return $this->belongsTo(Status::class);
    }

    public function setStatusIdAttribute($status): void
    {
        if (is_string($status)) {
            $this->attributes['status_id'] = Status::firstOrCreate([
                'name' => $status,
            ])->id;
        }
    }
}
