<?php

namespace App\Filament\Resources\IcontermsResource\Pages;

use App\Filament\Resources\IcontermsResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListIconterms extends ListRecords
{
    protected static string $resource = IcontermsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
