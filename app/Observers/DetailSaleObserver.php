<?php

namespace App\Observers;

use App\Models\DetailSale;
use App\Models\Log;
use Illuminate\Support\Facades\Auth;

class DetailSaleObserver
{
    /**
     * Handle the DetailSale "created" event.
     */
    public function created(DetailSale $detailSale): void
    {
        //
    }

    /**
     * Handle the DetailSale "updated" event.
     */
    public function updated(DetailSale $detailSale): void
    {
        // Si la venta está asentada, no debería poder actualizarse
        if ($detailSale->sale->state) {
            return;
        }

        // Obtenemos los cambios
        $changes = $detailSale->getDirty();
        
        // Excluimos timestamps
        $excludeColumns = ['updated_at', 'created_at'];
        
        // Obtenemos el usuario que realizó los cambios
        $userId = Auth::id() ?? $detailSale->sale->user_id;
        
        foreach ($changes as $field => $newValue) {
            // Saltamos los campos excluidos
            if (in_array($field, $excludeColumns)) {
                continue;
            }
            
            // Obtenemos el valor anterior
            $oldValue = $detailSale->getOriginal($field);
            
            // Convertimos a string para guardar en la BD
            $oldValueStr = is_null($oldValue) ? 'No definido' : (string) $oldValue;
            $newValueStr = is_null($newValue) ? 'No definido' : (string) $newValue;
            
            // Creamos el registro de log
            Log::create([
                'detail_sale_id' => $detailSale->id,
                'user_id' => $userId,
                'modified_field' => $field,
                'old_value' => $oldValueStr,
                'new_value' => $newValueStr,
                'modified_date' => now(),
            ]);
        }
    }

    /**
     * Handle the DetailSale "deleted" event.
     */
    public function deleted(DetailSale $detailSale): void
    {
        //
    }

    /**
     * Handle the DetailSale "restored" event.
     */
    public function restored(DetailSale $detailSale): void
    {
        //
    }

    /**
     * Handle the DetailSale "force deleted" event.
     */
    public function forceDeleted(DetailSale $detailSale): void
    {
        //
    }
}
