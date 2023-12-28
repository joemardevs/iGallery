<?php

namespace App\Filament\Admin\Pages;

use Filament\Pages\Page;

class Dashboard extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-home';
    protected static ?int $navigationSort = 0;
    protected static ?string $activeNavigationIcon = 'heroicon-s-home';

    protected static string $view = 'filament.admin.pages.dashboard';
}
