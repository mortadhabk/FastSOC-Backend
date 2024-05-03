<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Offer extends Model
{



    use HasFactory;


    // an offer belongs to an order
    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }
}
