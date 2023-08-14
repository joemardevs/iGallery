<?php

namespace App\Filament\Admin\Widgets\Dashboard;

use App\Models\Artwork;
use App\Models\Category;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class ArtworkCount extends BaseWidget
{
    protected function getStats(): array
    {

        return [
            //
            Stat::make('Total Artworks', Artwork::count())
                ->icon('heroicon-o-paint-brush')
                ->description('The total count of artwork')
                ->descriptionIcon('heroicon-o-arrow-trending-up')
                ->extraAttributes([
                    'class' => 'cursor-pointer',
                ]),
            Stat::make('Total Category', Category::count())
                ->icon('heroicon-o-tag')
                ->description('The total count of artwork')
                ->descriptionIcon('heroicon-o-arrow-trending-up')
                ->extraAttributes([
                    'class' => 'cursor-pointer',
                ]),
        ];
    }
}
