<?php

namespace App\Filament\Resources\DiasResource\Pages;

use App\Filament\Resources\DiasResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDias extends ListRecords
{
    protected static string $resource = DiasResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
