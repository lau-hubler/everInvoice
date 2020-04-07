<?php

namespace App;

use App\Concerns\ColumnFillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Invoice extends Model
{
    use ColumnFillable;

    public function vendor(): BelongsTo
    {
        return $this->belongsTo(Stakeholder::class, 'vendor_id');
    }

    public function client(): BelongsTo
    {
        return $this->belongsTo(Stakeholder::class, 'client_id');
    }

    public function status(): BelongsTo
    {
        return $this->belongsTo(Status::class);
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    public function products(): HasManyThrough
    {
        return $this->hasManyThrough(
            Product::class,
            Order::class,
            'invoice_id',
            'id',
            'id',
            'product_id'
        );
    }

    protected static function boot()
    {
        parent::boot();
        static::deleting(function ($model) {
            $model->orders()->each(function($order) {
                $order->delete();
            });
        });
    }

}
