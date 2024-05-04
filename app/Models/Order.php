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

    protected $fillable = [
        'customer_id',
        'offer_id',
        'licenses',
        'description',
    ];


    // an order belongs to a customer
    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    // an order belongs to many vendor
    public function vendors()
    {
        return $this->belongsToMany(Vendor::class)->withTimestamps();
    }

    // an order can have one offer
    public function offer(): BelongsTo
    {
        return $this->belongsTo(Offer::class);
    }
}
