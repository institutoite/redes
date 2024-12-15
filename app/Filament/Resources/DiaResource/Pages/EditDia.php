<?php

namespace App\Filament\Resources\DiaResource\Pages;

use App\Filament\Resources\DiaResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDia extends EditRecord
{
    protected static string $resource = DiaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
