<?php

namespace App\Filament\Widgets;

use App\Models\DetailSale;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class DetailSaleSecondStateOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Pendiente', DetailSale::query()->where('second_state_id','1')->count())
                ->description('Detalles de venta pendientes')
                ->descriptionIcon('heroicon-o-clock')
                ->color('warning'),
            Stat::make('Closed', DetailSale::query()->where('second_state_id','2')->count())
                ->description('Detalles de venta cerrados')
                ->descriptionIcon('heroicon-o-lock-closed')
                ->color('danger'),
            Stat::make('Aprobado', DetailSale::query()->where('second_state_id','3')->count())
                ->description('Detalles de venta aprobados')
                ->descriptionIcon('heroicon-o-check-circle')
                ->color('success'),
        ];
    }
}
