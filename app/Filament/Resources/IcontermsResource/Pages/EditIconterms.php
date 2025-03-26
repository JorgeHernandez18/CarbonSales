<?php

namespace App\Filament\Resources\IcontermsResource\Pages;

use App\Filament\Resources\IcontermsResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditIconterms extends EditRecord
{
    protected static string $resource = IcontermsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
