<?php

namespace App\Filament\Resources\Properties;

use App\Filament\Resources\Properties\Pages\CreateProperty;
use App\Filament\Resources\Properties\Pages\EditProperty;
use App\Filament\Resources\Properties\Pages\ListProperties;
use App\Filament\Resources\Properties\Schemas\PropertyForm;
use App\Filament\Resources\Properties\Tables\PropertiesTable;
use App\Models\Property;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use App\Filament\Resources\Properties\Pages;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;


class PropertyResource extends Resource
{
    protected static ?string $model = Property::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::Home ;
    protected static ?string $navigationLabel = 'Propriétés';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Informations')
                    ->schema([
                        TextInput::make('title')
                            ->label('Titre')
                            ->required(),

                        Textarea::make('description')
                            ->label('Description')
                            ->columnSpanFull(),

                        TextInput::make('price_per_night')
                            ->label('Prix par nuit')
                            ->numeric()
                            ->prefix('€')
                            ->required(),

                        TextInput::make('address')
                            ->label('Adresse')
                            ->required(),

                        TextInput::make('city')
                            ->label('Ville')
                            ->required(),

                        TextInput::make('country')
                            ->label('Pays')
                            ->required(),

                        TextInput::make('bedrooms')
                            ->label('Chambres')
                            ->numeric()
                            ->required(),

                        TextInput::make('bathrooms')
                            ->label('Salles de bain')
                            ->numeric()
                            ->required(),

                        TextInput::make('max_guests')
                            ->label('Nombre maximum de clients')
                            ->numeric()
                            ->required(),

                        TextInput::make('image_url')
                            ->label('URL de l\'image')
                            ->url(),

                        Toggle::make('is_available')
                            ->label('Disponible')
                            ->default(true),
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')
                    ->label('Titre')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('city')
                    ->label('Ville')
                    ->searchable(),

                TextColumn::make('price_per_night')
                    ->label('Prix par nuit')
                    ->money('EUR')
                    ->sortable(),

                IconColumn::make('is_available')
                    ->label('Disponible')
                    ->boolean(),
            ])
            ->filters([
                SelectFilter::make('city')
                    ->label('Ville')
                    ->options(
                        Property::query()->pluck('city', 'city')->toArray()
                    ),

                TernaryFilter::make('is_available')
                    ->label('Disponible'),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProperties::route('/'),
            'create' => Pages\CreateProperty::route('/create'),
            'edit' => Pages\EditProperty::route('/{record}/edit'),
        ];
    }
}