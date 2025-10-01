<?php

namespace App\Filament\Resources\Blogs\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\DateTimePicker;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class BlogForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Blog Details')
                ->columns(2)
                ->schema([
                    TextInput::make('title')
                        ->required()
                        ->maxLength(255)
                        ->live(debounce: 500)
                        ->afterStateUpdated(function (callable $set, ?string $state) {
                            if (filled($state)) {
                                $set('slug', Str::slug($state));
                            }
                        }),

                    TextInput::make('slug')
                        ->required()
                        ->maxLength(255)
                        ->unique(ignoreRecord: true),

                    // Categories (multi-select via many-to-many)
                    Select::make('categories')
                        ->label('Categories')
                        ->relationship('categories', 'title')
                        ->multiple()
                        ->preload()
                        ->required()
                        ->columnSpanFull(),

                    RichEditor::make('excerpt')
                        ->label('Excerpt')
                        ->fileAttachmentsDirectory('blog_attachments')
                        ->required()
                        ->columnSpanFull(),

                    RichEditor::make('description')
                        ->label('Description')
                        ->fileAttachmentsDirectory('blog_attachments')
                        ->required()
                        ->columnSpanFull(),

                    FileUpload::make('thumbnail')
                        ->label('Thumbnail')
                        ->image()
                        ->directory('blogs')
                        ->imageEditor()
                        ->required(),

                    FileUpload::make('featured_image')
                        ->label('Featured Image')
                        ->image()
                        ->directory('blogs')
                        ->imageEditor()
                        ->required(),

                    DateTimePicker::make('published_at')
                        ->label('Published At')
                        ->required(),

                    Select::make('status')
                        ->options([
                            'draft'     => 'Draft',
                            'scheduled' => 'Scheduled',
                            'published' => 'Published',
                        ])
                        ->required(),

                    Toggle::make('is_featured')
                        ->label('Featured')
                        ->required(),

                    TextInput::make('view_count')
                        ->numeric()
                        ->minValue(0)
                        ->default(0)
                        ->required(),

                    TextInput::make('reading_time')
                        ->numeric()
                        ->minValue(1)
                        ->required()
                        ->helperText('Approx minutes to read'),

                    TextInput::make('video_url')
                        ->url()
                        ->nullable(),

                    TextInput::make('location')
                        ->nullable(),

                    TextInput::make('meta_title')
                        ->required()
                        ->maxLength(255),

                    TextInput::make('meta_description')
                        ->required()
                        ->maxLength(1000),

                    Hidden::make('created_by')
                        ->default(fn () => auth()->id())
                        ->dehydrated(true),
                ])->columnSpanFull(),
        ]);
    }
}
