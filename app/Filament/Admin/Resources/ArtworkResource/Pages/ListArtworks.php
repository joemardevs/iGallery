<?php

namespace App\Filament\Admin\Resources\ArtworkResource\Pages;

use App\Filament\Admin\Resources\ArtworkResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListArtworks extends ListRecords
{
    protected static string $resource = ArtworkResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
