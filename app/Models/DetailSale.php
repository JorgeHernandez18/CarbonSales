<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Auth;

class DetailSale extends Model
{
    //
    protected $fillable = [
        'sale_id',
        'year',
        'third',
        'buque',
        'from',
        'to',
        'ETA',
        'BL',
        'TM',
        'load_rate',
        'OVH',
        'supplier_id',
        'shipper_id',
        'material_id',
        'type_id',
        'size_id',
        'destination_country_id',
        'sale_state_id',
        'lab_id',
        'agency_id',
        'second_state_id',
        'port_id',
        'discharge_port_id',
        'ops_id',
        'inconterm_id',
    ];

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

    public function ops() : BelongsTo
    {
        return $this->belongsTo(Ops::class);
    }

    public function inconterm() : BelongsTo
    {
        return $this->belongsTo(Iconterm::class);
    }

    protected static function boot() {
        parent::boot();
    
        static::updating(function ($detailSale) {
            foreach ($detailSale->getDirty() as $field => $newValue) {
                $oldValue = $detailSale->getOriginal($field) ?: 'N/A';
    
                // Verificar si el campo es una relación y obtener el nombre en lugar del ID
                $relations = [
                    'supplier_id' => Supplier::class,
                    'shipper_id' => Shipper::class,
                    'material_id' => Material::class,
                    'type_id' => Type::class,
                    'size_id' => Size::class,
                    'destination_country_id' => DestinationCountry::class,
                    'sale_state_id' => SaleState::class,
                    'lab_id' => Lab::class,
                    'agency_id' => Agency::class,
                    'second_state_id' => SecondState::class,
                    'port_id' => Port::class,
                    'discharge_port_id' => DischargePort::class,
                    'ops_id'=> Ops::class,
                    'inconterm_id'=> Iconterm::class,
                ];

                $fields = [
                    'supplier_id' => 'Suplidor',
                    'shipper_id' => 'Embarcador',
                    'material_id' => 'Material',
                    'type_id' => 'Tipo',
                    'size_id' => 'Tamaño',
                    'destination_country_id' => 'País de Destino',
                    'sale_state_id' => 'Estado de Venta',
                    'lab_id' => 'Laboratorio',
                    'agency_id' => 'Agencia',
                    'second_state_id' => 'Segundo Estado',
                    'port_id' => 'Puerto',
                    'discharge_port_id' => 'Puerto de Descarga',
                    'ops_id' => 'OPS',
                    'inconterm_id' => 'Inconterms',
                ];
    
                if (array_key_exists($field, $relations)) {
                    $oldValue = $relations[$field]::find($oldValue)?->name ?? 'N/A';
                    $newValue = $relations[$field]::find($newValue)?->name ?? 'N/A';
                }

                if (array_key_exists($field, $fields)) {
                    $field = $fields[$field];
                }
    
                Log::create([
                    'detail_sale_id' => $detailSale->id,
                    'user_id' => Auth::id(),
                    'modified_field' => $field,
                    'old_value' => $oldValue,
                    'new_value' => $newValue,
                    'modified_date' => now(),
                ]);
            }
        });
    }
}
