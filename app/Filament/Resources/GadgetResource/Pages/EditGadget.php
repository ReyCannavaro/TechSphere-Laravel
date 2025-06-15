<?php

namespace App\Filament\Resources\GadgetResource\Pages;

use App\Filament\Resources\GadgetResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditGadget extends EditRecord
{
    protected static string $resource = GadgetResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
