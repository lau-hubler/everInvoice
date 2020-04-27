<?php

namespace App;

use App\Concerns\ColumnFillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Stakeholder extends Model
{
    use ColumnFillable;
    use SoftDeletes;

    public function documentType(): BelongsTo
    {
        return $this->belongsTo(DocumentType::class);
    }

    public function invoicesReceived(): HasMany
    {
        return $this->hasMany(Invoice::class, 'id', 'client_id');
    }

    public function invoicesEmitted(): HasMany
    {
        return $this->hasMany(Invoice::class, 'id', 'vendor_id');
    }

    public function scopeWithDocumentType()
    {
        return Stakeholder::with('documentType');
    }
}
