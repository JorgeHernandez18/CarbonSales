<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Size extends Model
{
    //
    protected $fillable = [
        'name',
        'description',
    ];

    public function detail_sales() : HasMany
    {
        return $this->hasMany(DetailSale::class);        
    }
}
