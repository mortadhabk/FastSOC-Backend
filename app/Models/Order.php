<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Order extends Model
{
    use HasFactory;


    // an order belongs to a customer
    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    // an order can have many vendor
    public function vendors(): HasMany
    {
        return $this->hasMany(Vendor::class);
    }

    // an order can have one offer
    public function offer(): HasOne
    {
        return $this->hasOne(Offer::class);
    }
}
