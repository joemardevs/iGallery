<?php

namespace App\Filament\Admin\Resources\ArtistResource\Pages;

use App\Filament\Admin\Resources\ArtistResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\Hash;

class EditArtist extends EditRecord
{
    protected static string $resource = ArtistResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
    public function mutateFormDataBeforeSave(array $data): array
    {
        if (array_key_exists('new_password', $data) || filled($data['new_password'])) {
            $this->record->password = Hash::make($data['new_password']);
        }
        return $data;
    }
}
