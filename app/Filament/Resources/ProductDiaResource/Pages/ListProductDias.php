<?php
namespace App\Filament\Resources\ProductDiaResource\Pages;

use App\Filament\Resources\ProductDiaResource;
use Filament\Resources\Pages\ListRecords;

class ListProductDias extends ListRecords
{
    protected static string $resource = ProductDiaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\CreateAction::make(),
        ];
    }
}
