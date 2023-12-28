<?php

namespace App\Filament\Admin\Resources\ArtworkResource\Pages;

use App\Filament\Admin\Resources\ArtworkResource;
use App\Models\Artwork;
use Filament\Actions;
use Filament\Resources\Components\Tab;
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
    public function getTabs(): array
    {
        return [
            // 'All' => Tab::make(),
            'Not Sold' => Tab::make('Not Sold')
                // ->badge(Artwork::query()->where('is_sold', false)->count())
                ->modifyQueryUsing(fn ($query) => $query->where('is_sold', false)),
            'Sold' => Tab::make('Sold')
                // ->badge(Artwork::query()->where('is_sold', true)->count())
                ->modifyQueryUsing(fn ($query) => $query->where('is_sold', true)),
        ];
    }
}
