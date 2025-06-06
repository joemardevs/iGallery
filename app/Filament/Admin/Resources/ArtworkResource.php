<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\ArtworkResource\Pages;
use App\Models\Artwork;
use App\Models\Category;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ArtworkResource extends Resource
{
    protected static ?string $model = Artwork::class;

    protected static ?string $navigationGroup = 'Management';
    protected static ?string $navigationIcon = 'heroicon-o-paint-brush';
    protected static ?int $navigationSort = 2;
    protected static ?string $activeNavigationIcon = 'heroicon-s-paint-brush';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\FileUpload::make('artwork_image')
                    ->label('Artwork Image')
                    ->required()
                    ->image()
                    ->optimize('webp'),
                Forms\Components\Textarea::make('description')
                    ->required()
                    ->minLength(2)
                    ->maxLength(1000)
                    ->rows(10),
                Forms\Components\TextInput::make('title')
                    ->required()
                    ->minLength(2)
                    ->maxLength(255),
                Forms\Components\Select::make('category_id')
                    ->label('Category')
                    ->relationship('category', 'name')
                    ->required()
                    ->native(false)
                    ->createOptionForm(
                        [
                            Forms\Components\TextInput::make('name')
                                ->required()
                        ]
                    ),
                TagsInput::make('theme')
                    ->label('Theme')
                    ->placeholder('Add a theme'),
                Forms\Components\Select::make('artist_id')
                    ->label('Artist')
                    ->required()
                    ->native(false)
                    ->options(function () {
                        // Retrieve artists from the User model with usertype 'artist'
                        return User::where('usertype', 'artist')->pluck('name', 'id');
                    }),
                Forms\Components\TextInput::make('contact')
                    ->required(),
                Forms\Components\TextInput::make('address')
                    ->required(),
                Forms\Components\TextInput::make('size')
                    ->maxLength(255),
                Forms\Components\TextInput::make('price')
                    ->required()
                    ->numeric()
                    ->prefix('PHP'),
                Forms\Components\TextInput::make('medium')
                    ->maxLength(255),
                Forms\Components\Toggle::make('is_sold')
                    ->label('Is Sold'),
                Forms\Components\DatePicker::make('created_date'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('artwork_image')
                    ->label('Image'),
                Tables\Columns\TextColumn::make('title')
                    ->searchable(),
                Tables\Columns\TextColumn::make('artist.name')
                    ->label('Artist Name')
                    ->searchable(),
                Tables\Columns\SelectColumn::make('category_id')
                    ->label('Category')
                    ->options(Category::pluck('name', 'id')),
                Tables\Columns\TextColumn::make('price')
                    ->money('php')
                    ->sortable(),
                Tables\Columns\ToggleColumn::make('is_sold')
                    ->label('Sold'),
                Tables\Columns\TextColumn::make('created_date')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->date()
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

    // public static function getNavigationBadge(): ?string
    // {
    //     return static::getModel()::count();
    // }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListArtworks::route('/'),
            'create' => Pages\CreateArtwork::route('/create'),
            'edit' => Pages\EditArtwork::route('/{record}/edit'),
        ];
    }
}
