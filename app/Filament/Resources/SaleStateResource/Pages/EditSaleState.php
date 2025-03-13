<?php

namespace App\Filament\Resources\SaleStateResource\Pages;

use App\Filament\Resources\SaleStateResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSaleState extends EditRecord
{
    protected static string $resource = SaleStateResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
