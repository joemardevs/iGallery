<?php

namespace App\Filament\Admin\Resources\UserResource\Pages;

use App\Filament\Admin\Resources\UserResource;
use App\Models\User;
use Filament\Actions;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;

class ListUsers extends ListRecords
{
    protected static string $resource = UserResource::class;

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
            'User' => Tab::make('User')
                // ->badge(User::query()->where('usertype', 'user')->count())
                ->modifyQueryUsing(fn ($query) => $query->where('usertype', 'user')),
            'Artist' => Tab::make('Artist')
                // ->badge(User::query()->where('usertype', 'artist')->count())
                ->modifyQueryUsing(fn ($query) => $query->where('usertype', 'artist')),
        ];
    }
}
