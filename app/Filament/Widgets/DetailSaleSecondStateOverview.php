<?php

namespace App\Filament\Widgets;


use App\Models\Material;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class DetailSaleSecondStateOverview extends BaseWidget
{
    protected function getStats(): array
    {
        $stats = [];

        $materiales = Material::with('detail_sales')->get();

        foreach ($materiales as $material) {
            $ventas = $material->detail_sales()->count();
            $toneladas = $material->detail_sales()->sum('TM');
            $loadRate = $material->detail_sales()->sum('load_rate');
            $aprobado = $material->detail_sales()->where('second_state_id', 3)->count();
            $pendiente = $material->detail_sales()->where('second_state_id', 1)->count();
            $cerrado = $material->detail_sales()->where('second_state_id', 2)->count();

            $stats[] = Stat::make("Ventas ({$material->name})", $ventas)
                ->description("Total ventas de {$material->name}")
                ->descriptionIcon('heroicon-o-currency-dollar')
                ->color('gray');

            $stats[] = Stat::make("Toneladas ({$material->name})", number_format($toneladas, 2, '.', ','))
                ->description("Toneladas de {$material->name}")
                ->descriptionIcon('heroicon-o-scale')
                ->color('info');

            $stats[] = Stat::make("Load Rate ({$material->name})", '$' . number_format($loadRate, 2, '.', ','))
                ->description("Load rate de {$material->name}")
                ->descriptionIcon('heroicon-o-currency-dollar')
                ->color('success');

            $stats[] = Stat::make("Aprobado ({$material->name})", $aprobado)
                ->description("Aprobados de {$material->name}")
                ->descriptionIcon('heroicon-o-check-circle')
                ->color('success');

            $stats[] = Stat::make("Pendiente ({$material->name})", $pendiente)
                ->description("Pendientes de {$material->name}")
                ->descriptionIcon('heroicon-o-clock')
                ->color('warning');

            $stats[] = Stat::make("Cerrado ({$material->name})", $cerrado)
                ->description("Cerrados de {$material->name}")
                ->descriptionIcon('heroicon-o-lock-closed')
                ->color('danger');
        }

        return $stats;
        
    }
}
