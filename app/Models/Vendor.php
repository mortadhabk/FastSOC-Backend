<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Vendor extends Model
{
    use HasFactory;


    // a vendor belongs to an order
    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }
}
