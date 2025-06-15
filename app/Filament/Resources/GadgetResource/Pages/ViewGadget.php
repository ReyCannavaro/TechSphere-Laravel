<?php

namespace App\Filament\Resources\GadgetResource\Pages; // This is the correct namespace

use App\Filament\Resources\GadgetResource; // This points to your GadgetResource
use Filament\Actions; // Import Actions if you want edit buttons etc.
use Filament\Resources\Pages\ViewRecord; // This is the base class for viewing records

class ViewGadget extends ViewRecord
{
    // This tells Filament which Resource this page belongs to
    protected static string $resource = GadgetResource::class;

    // Optional: Add actions to the header of the view page (e.g., an Edit button)
    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(), // This adds an "Edit" button to the view page
        ];
    }
}