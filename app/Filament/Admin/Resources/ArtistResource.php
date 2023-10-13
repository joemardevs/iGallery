<?php

namespace App\Filament\Admin\Resources;

use App\Enums\UserTypeEnum;
use App\Filament\Admin\Resources\ArtistResource\Pages;
use App\Filament\Admin\Resources\ArtistResource\Pages\CreateArtist;
use App\Filament\Admin\Resources\ArtistResource\Pages\EditArtist;
use App\Models\User;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Support\Enums\IconPosition;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class ArtistResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationGroup = 'Management';
    protected static ?string $label = 'Artists';
    protected static ?int $navigationSort = 0;
    protected static ?string $navigationIcon = 'heroicon-o-user-group';
    protected static ?string $activeNavigationIcon = 'heroicon-s-user-group';



    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('User Details')
                    ->schema([
                        TextInput::make('name')
                            ->required()
                            ->minLength(2),
                        TextInput::make('email')
                            ->email()
                            ->required()
                            ->unique(ignoreRecord: true),
                        TextInput::make('password')
                            ->password()
                            ->required()
                            ->dehydrateStateUsing(fn ($state) => Hash::make($state))
                            ->visible(fn ($livewire) => $livewire instanceof CreateArtist)
                            ->rule(Password::default()),
                        DateTimePicker::make('email_verified_at')
                            ->required(),
                        FileUpload::make('profile_img'),
                    ])->columns(2),
                Section::make('User New Password')->schema([
                    TextInput::make('new_password')
                        ->label('New Password')
                        ->password()
                        ->nullable()
                        ->rule(Password::default()),
                    TextInput::make('new_password_confirmation')
                        ->label('New Password Confirmation')
                        ->password()
                        ->same('new_password')
                        ->requiredWith('new_password')
                ])->visible(fn ($livewire) => $livewire instanceof EditArtist)
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->query(User::where('usertype', UserTypeEnum::ARTIST->value))
            ->columns([
                //
                ImageColumn::make('profile_img')
                    ->label('Avatar')
                    ->circular()
                    ->defaultImageUrl(fn ($record) => $record->avatar_url),
                TextColumn::make('name')->searchable(),
                TextColumn::make('email')->searchable()
                    ->icon('heroicon-m-envelope')
                    ->iconPosition(IconPosition::Before),

            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            //comment if you want a modal
            'index' => Pages\ListArtists::route('/'),
            'create' => Pages\CreateArtist::route('/create'),
            'edit' => Pages\EditArtist::route('/{record}/edit'),
        ];
    }
}
