<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'siret', 
        'siren',
        'legal_name',
    ];

    // a customer can have many orders
    public function offers(): HasMany
    {
        return $this->hasMany(Offer::class);
    }
}
