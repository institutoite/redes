<?php

namespace App\Filament\Resources\DiaResource\Pages;

use App\Filament\Resources\DiaResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDias extends ListRecords
{
    protected static string $resource = DiaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
