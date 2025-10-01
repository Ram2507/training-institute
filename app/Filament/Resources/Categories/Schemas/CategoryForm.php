<?php

namespace App\Filament\Resources\Categories\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\RichEditor;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class CategoryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Category Details')
                ->columns(1)
                ->schema([
                    TextInput::make('title')
                        ->label('Title')
                        ->required()
                        ->maxLength(255)
                        ->live(debounce: 500)
                        ->afterStateUpdated(function (callable $set, ?string $state) {
                            if (filled($state)) {
                                $set('slug', Str::slug($state));
                            }
                        }),

                    TextInput::make('slug')
                        ->label('Slug')
                        ->required()
                        ->maxLength(255)
                        ->unique(ignoreRecord: true),

                    RichEditor::make('description')
                        ->label('Description')
                        ->required()
                        ->columnSpanFull(),

                    FileUpload::make('thumbnail')
                        ->label('Thumbnail')
                        ->image()
                        ->required()
                        ->directory('categories')
                        ->imageEditor(),

                    Toggle::make('is_active')
                        ->label('Active')
                        ->required(),

                    Hidden::make('created_by')
                        ->default(fn () => auth()->id())
                        ->dehydrated(true),

                    TextInput::make('canonical_url')
                        ->label('Canonical URL')
                        ->url()
                        ->required(),

                    TextInput::make('meta_title')
                        ->label('Meta Title')
                        ->required()
                        ->maxLength(255),

                    TextInput::make('meta_description')
                        ->label('Meta Description')
                        ->required()
                        ->maxLength(1000),
                ])->columnSpanFull(),
        ]);
    }
}
