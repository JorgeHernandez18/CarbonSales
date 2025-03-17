<?php

namespace App\Filament\Resources\DischargePortResource\Pages;

use App\Filament\Resources\DischargePortResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDischargePort extends EditRecord
{
    protected static string $resource = DischargePortResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
