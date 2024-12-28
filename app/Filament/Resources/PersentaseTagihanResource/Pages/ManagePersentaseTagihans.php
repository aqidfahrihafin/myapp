<?php

namespace App\Filament\Resources\PersentaseTagihanResource\Pages;

use App\Filament\Resources\PersentaseTagihanResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManagePersentaseTagihans extends ManageRecords
{
    protected static string $resource = PersentaseTagihanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
    public function getTitle(): string{
        return "Persentase";
    }
}
