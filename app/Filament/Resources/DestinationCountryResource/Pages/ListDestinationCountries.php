<?php

namespace App\Filament\Resources\DestinationCountryResource\Pages;

use App\Filament\Resources\DestinationCountryResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDestinationCountries extends ListRecords
{
    protected static string $resource = DestinationCountryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
