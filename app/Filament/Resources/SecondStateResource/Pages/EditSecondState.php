<?php

namespace App\Filament\Resources\SecondStateResource\Pages;

use App\Filament\Resources\SecondStateResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSecondState extends EditRecord
{
    protected static string $resource = SecondStateResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
