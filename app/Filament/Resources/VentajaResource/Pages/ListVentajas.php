<?php

namespace App\Filament\Resources\VentajaResource\Pages;

use App\Filament\Resources\VentajaResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListVentajas extends ListRecords
{
    protected static string $resource = VentajaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
