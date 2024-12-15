<?php

namespace App\Filament\Resources\ModalidadResource\Pages;

use App\Filament\Resources\ModalidadResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListModalidads extends ListRecords
{
    protected static string $resource = ModalidadResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
