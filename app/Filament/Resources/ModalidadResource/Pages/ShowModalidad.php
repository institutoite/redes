<?php

namespace App\Filament\Resources\ModalidadResource\Pages;

use Filament\Resources\Pages\ViewRecord;
use App\Filament\Resources\ModalidadResource;

class ShowModalidad extends ViewRecord
{
    protected static string $resource = ModalidadResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Puedes agregar acciones adicionales aquí si es necesario
        ];
    }
    
}
