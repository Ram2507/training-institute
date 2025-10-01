<?php

namespace App\Filament\Resources\Blogs\Tables;

use Filament\Tables\Table;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Actions\CreateAction;
use Filament\Actions\ViewAction;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;

class BlogsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('thumbnail')
                    ->label('Thumbnail')
                    ->square()
                    ->size(48),

                TextColumn::make('title')
                    ->label('Title')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('categories.title')
                    ->label('Categories')
                    ->formatStateUsing(fn ($state, $record) =>
                        $record->categories?->pluck('title')->join(', ') ?: '—'
                    )
                    ->toggleable(),

                TextColumn::make('created_by')
                    ->label('Created By')
                    ->formatStateUsing(fn ($state, $record) =>
                        $record->createdBy ? ($record->createdBy->name . ' (' . $record->created_by . ')') : '—'
                    )
                    ->sortable(),

                TextColumn::make('updated_at')
                    ->label('Last Updated')
                    ->dateTime('M d, Y H:i'),
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                CreateAction::make(),
                DeleteBulkAction::make(),
            ]);
    }
}
