<?php

namespace App\Filament\Admin\Widgets\Dashboard;

use App\Models\Artist;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class UserCount extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            //
            Stat::make('Users', User::where('usertype', ['user', '', null])->count())
                ->icon('heroicon-s-user-group')
                ->description('The total count of users'),
            // ->descriptionIcon('heroicon-o-arrow-trending-up')
            // ->extraAttributes([
            //     'class' => 'cursor-pointer',
            // ]),
            Stat::make('Artists', User::where('usertype', 'artist')->count())
                ->icon('heroicon-s-users')
                ->description('The total count of artists')
            // ->descriptionIcon('heroicon-o-arrow-trending-up')
            // ->extraAttributes([
            //     'class' => 'cursor-pointer',
            // ]),
        ];
    }
    protected function getColumns(): int
    {
        return 2;
    }
}
