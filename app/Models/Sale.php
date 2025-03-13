<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Sale extends Model
{
    //

    public function detail_sale() : HasOne
    {
        return $this->hasOne(DetailSale::class);
        
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
