<?php

namespace App\Filament\Resources\SaleStateResource\Pages;

use App\Filament\Resources\SaleStateResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSaleStates extends ListRecords
{
    protected static string $resource = SaleStateResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
