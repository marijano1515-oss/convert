<?php

namespace App\Filament\Resources\Converts\Pages;

use App\Filament\Resources\Converts\ConvertResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditConvert extends EditRecord
{
    protected static string $resource = ConvertResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
