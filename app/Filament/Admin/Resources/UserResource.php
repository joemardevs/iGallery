<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Columns\SelectColumn;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Section;
use Filament\Support\Enums\IconPosition;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationGroup = 'Management';
    protected static ?string $navigationIcon = 'heroicon-o-users';
    protected static ?int $navigationSort = 0;
    protected static ?string $activeNavigationIcon = 'heroicon-s-users';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
                TextInput::make('name')
                    ->required()
                    ->minLength(2),
                TextInput::make('email')
                    ->email()
                    ->required(),
                TextInput::make('password')
                    ->password()
                    ->required(),
                DateTimePicker::make('email_verified_at')
                    ->required(),
                FileUpload::make('profile_img'),
                Select::make('usertype')
                    ->options([
                        'artist' => 'Artist',
                        'user' => 'User',
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->query(User::displayUserAndArtistOnly())
            ->columns([
                //
                ImageColumn::make('profile_img')
                    ->circular()
                    ->defaultImageUrl(fn ($record) => $record->avatar_url),
                TextColumn::make('name')->searchable(),
                TextColumn::make('email')->searchable()
                    ->icon('heroicon-m-envelope')
                    ->iconPosition(IconPosition::Before),
                SelectColumn::make('usertype')
                    ->options([
                        'artist' => 'Artist',
                        'user' => 'User',
                    ]),
            ])
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
