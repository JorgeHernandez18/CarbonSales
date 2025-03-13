<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Sale extends Model
{
    //

    public function detail_sale() : HasMany
    {
        return $this->hasMany(DetailSale::class);
        
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
