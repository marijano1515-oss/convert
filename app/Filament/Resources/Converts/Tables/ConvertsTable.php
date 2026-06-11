<?php

namespace App\Filament\Resources\Converts\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ConvertsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->label('ID'),
                TextColumn::make('amount')->label('amount converted'),
                TextColumn::make('currency')->label('currency to convert'),
                TextColumn::make('rate')->label('rate converted'),
                TextColumn::make('result')->label('result in gel'),
                TextColumn::make('created_at')->label('date converted'),

            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
