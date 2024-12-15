<?php

namespace App\Filament\Resources\ModalidadResource\Pages;

use App\Filament\Resources\ModalidadResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditModalidad extends EditRecord
{
    protected static string $resource = ModalidadResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
