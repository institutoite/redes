<?php

namespace App\Filament\Resources\DiasResource\Pages;

use App\Filament\Resources\DiasResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDias extends EditRecord
{
    protected static string $resource = DiasResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
