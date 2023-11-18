<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\UserResource\Pages;
use App\Filament\Admin\Resources\UserResource\Pages\CreateUser;
use App\Filament\Admin\Resources\UserResource\Pages\EditUser;
use App\Models\User;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Support\Enums\IconPosition;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationGroup = 'Management';
    protected static ?string $navigationIcon = 'heroicon-o-users';
    protected static ?int $navigationSort = 1;
    protected static ?string $activeNavigationIcon = 'heroicon-s-users';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
                Section::make('User Details')->schema([
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
                        ->visible(fn ($livewire) => $livewire instanceof CreateUser)
                        ->rule(Password::default()),
                    DateTimePicker::make('email_verified_at')
                        ->required(),
                    FileUpload::make('profile_img')
                        ->label('Avatar'),
                    Select::make('usertype')
                        ->options([
                            'user' => 'User',
                            'artist' => 'Artist',
                        ])
                        ->native(false)
                        ->label('Usertype'),
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
                ])->visible(fn ($livewire) => $livewire instanceof EditUser)
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->query(User::displayUserAndArtistOnly())
            ->columns([
                //
                ImageColumn::make('profile_img')
                    ->label('Avatar')
                    ->circular()
                    ->defaultImageUrl(fn ($record) => $record->avatar_url),
                TextColumn::make('name')
                    ->searchable(),
                TextColumn::make('email')
                    ->searchable()
                    ->icon('heroicon-m-envelope')
                    ->iconPosition(IconPosition::Before),
                TextColumn::make('usertype')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->sortable(),
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
