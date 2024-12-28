<?php

namespace App\Filament\Resources\RayonResource\Pages;

use App\Filament\Resources\RayonResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageRayons extends ManageRecords
{
    protected static string $resource = RayonResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    public function getTitle(): string{
        return "Rayon";
    }
}
