<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Log extends Model
{
    //
    protected $fillable = [
        'detail_sale_id',
        'user_id',
        'modified_field',
        'old_value',
        'new_value',
        'modified_date', 
    ];

    public function user():BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function detail_sale(): BelongsTo
    {
        return $this->belongsTo(DetailSale::class);
    }
}
