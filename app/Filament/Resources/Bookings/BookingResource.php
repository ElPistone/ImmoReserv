<?php

namespace App\Filament\Resources\Bookings;

use App\Filament\Resources\Bookings\Pages\CreateBooking;
use App\Filament\Resources\Bookings\Pages\EditBooking;
use App\Filament\Resources\Bookings\Pages\ListBookings;
use App\Filament\Resources\Bookings\Schemas\BookingForm;
use App\Filament\Resources\Bookings\Tables\BookingsTable;
use App\Models\Booking;
use Filament\Schemas\Components\Section;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use App\Enums\BookingStatus;

class BookingResource extends Resource
{
    protected static ?string $model = Booking::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::Calendar ;
    protected static ?string $navigationLabel = 'Réservations';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Réservation')
                    ->schema([
                        Select::make('user_id')
                            ->label('Utilisateur')
                            ->relationship('user', 'name')
                            ->required(),

                        Select::make('property_id')
                            ->label('Propriété')
                            ->relationship('property', 'title')
                            ->required(),

                        DatePicker::make('start_date')
                            ->label('Date de début')
                            ->required(),

                        DatePicker::make('end_date')
                            ->label('Date de fin')
                            ->required(),

                        TextInput::make('guests')
                            ->label('Nombre de clients')
                            ->label('Nombre de clients')
                            ->numeric()
                            ->required(),

                        TextInput::make('total_price')
                            ->label('Prix total')
                            ->numeric()
                            ->prefix('€')
                            ->required(),

                        Select::make('status')
                            ->label('Statut')
                            ->options(BookingStatus::toArray())
                            ->required(),

                        Textarea::make('special_requests')
                            ->label('Demandes spéciales'),
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user.name')->label('Utilisateur')->searchable(),
                TextColumn::make('property.title')->label('Propriété')->searchable(),
                TextColumn::make('start_date')->label('Date de début')->date(),
                TextColumn::make('end_date')->label('Date de fin')->date(),
                TextColumn::make('total_price')->label('Prix total')->money('EUR'),
                TextColumn::make('status')->label('Statut')->badge(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBookings::route('/'),
            'create' => Pages\CreateBooking::route('/create'),
            'edit' => Pages\EditBooking::route('/{record}/edit'),
        ];
    }
}
