<?php

namespace App\Filament\Resources\Converts\Pages;

use App\Filament\Resources\Converts\ConvertResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListConverts extends ListRecords
{
    protected static string $resource = ConvertResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
