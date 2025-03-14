<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Log extends Model
{
    //

    public function user():BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function detail_sale(): BelongsTo
    {
        return $this->belongsTo(DetailSale::class);
    }
}
