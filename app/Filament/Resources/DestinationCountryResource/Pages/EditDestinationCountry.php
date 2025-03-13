<?php

namespace App\Filament\Resources\DestinationCountryResource\Pages;

use App\Filament\Resources\DestinationCountryResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDestinationCountry extends EditRecord
{
    protected static string $resource = DestinationCountryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
