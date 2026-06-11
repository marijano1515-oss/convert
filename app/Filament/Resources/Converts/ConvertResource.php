<?php

namespace App\Filament\Resources\Converts;

use App\CurrencyConverter;
use App\Filament\Resources\Converts\Pages\CreateConvert;
use App\Filament\Resources\Converts\Pages\EditConvert;
use App\Filament\Resources\Converts\Pages\ListConverts;
use App\Filament\Resources\Converts\Tables\ConvertsTable;
use App\Models\Convert;
use BackedEnum;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class ConvertResource extends Resource
{
    protected static ?string $model = Convert::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::CurrencyDollar;

    protected static ?string $recordTitleAttribute = 'currency';

    public static function form(Schema $schema): Schema
    {
        return $schema->schema([
            TextInput::make('amount')
                ->label('Amount to Convert')
                ->numeric()
                ->required()
                ->live()
                ->afterStateUpdated(function (Get $get, Set $set) {
                    $rate = $get('rate') ?? 0;
                    $amount = $get('amount') ?? 0;

                    $set('result', $amount * $rate);
                }),

            Select::make('currency')
                ->label('Select Currency')
                ->options([
                    'USD' => 'USD',
                    'EUR' => 'EUR',
                ])
                ->required()
                ->live()
                ->afterStateUpdated(function ($state, Get $get, Set $set) {
                    $rates = (new \App\CurrencyConverter)->getRates();

                    $rate = $rates[$state] ?? 0;

                    $set('rate', $rate);
                    $set('result', ($get('amount') ?? 0) * $rate);
                }),

            TextInput::make('rate')
                ->numeric()
                ->readOnly()
                ->required(),

            TextInput::make('result')
                ->numeric()
                ->readOnly()
                ->required(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return ConvertsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListConverts::route('/'),
            'create' => CreateConvert::route('/create'),
            'edit' => EditConvert::route('/{record}/edit'),
        ];
    }
}
