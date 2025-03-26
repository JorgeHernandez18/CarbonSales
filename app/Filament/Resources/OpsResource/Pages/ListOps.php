<?php

namespace App\Filament\Resources\OpsResource\Pages;

use App\Filament\Resources\OpsResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListOps extends ListRecords
{
    protected static string $resource = OpsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
