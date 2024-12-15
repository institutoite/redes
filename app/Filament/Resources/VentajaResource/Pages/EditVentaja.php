<?php

namespace App\Filament\Resources\VentajaResource\Pages;

use App\Filament\Resources\VentajaResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditVentaja extends EditRecord
{
    protected static string $resource = VentajaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
