<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Auth;

class DetailSale extends Model
{
    //

    public function sale() : BelongsTo
    {
        return $this->belongsTo(Sale::class);
        
    }

    public function logs() : HasMany
    {
        return $this->hasMany(Log::class);
    }

    public function supplier() : BelongsTo
    {
        return $this->belongsTo(Supplier::class);
    }

    public function shipper() : BelongsTo
    {
        return $this->belongsTo(Shipper::class);
    }

    public function material() : BelongsTo
    {
        return $this->belongsTo(Material::class);
    }

    public function type() : BelongsTo
    {
        return $this->belongsTo(Type::class);
    }   

    public function size() : BelongsTo
    {
        return $this->belongsTo(Size::class);
    }   

    public function destination_country() : BelongsTo
    {
        return $this->belongsTo(DestinationCountry::class, 'destination_country_id');
    }

    public function sale_state() : BelongsTo
    {
        return $this->belongsTo(SaleState::class);
    }

    public function lab(): BelongsTo
    {
        return $this->belongsTo(Lab::class);
    }

    public function agency() : BelongsTo
    {
        return $this->belongsTo(Agency::class);
    }

    public function second_state() : BelongsTo
    {
        return $this->belongsTo(SecondState::class);
    }

    public function discharge_port() : BelongsTo
    {
        return $this->belongsTo(DischargePort::class, 'discharge_port_id');
    }

    public function port() : BelongsTo
    {
        return $this->belongsTo(Port::class);
    }

    protected static function boot() {
        parent::boot();

        static::updating(function ($detailSale) {
            foreach ($detailSale->getDirty() as $field => $newValue) {
                Log::create([
                    'detail_sale_id' => $detailSale->id,
                    'user_id' => Auth::id(),
                    'modified_field' => $field,
                    'old_value' => $detailSale->getOriginal($field) ?: 'N/A',
                    'new_value' => $newValue,
                    'modified_date' => now(),
                ]);
            }
        });
    }
}
