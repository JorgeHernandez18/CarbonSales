<?php

namespace App\Filament\Resources\SecondStateResource\Pages;

use App\Filament\Resources\SecondStateResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSecondStates extends ListRecords
{
    protected static string $resource = SecondStateResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
