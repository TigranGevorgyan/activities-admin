<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ActivityResource\Pages;
use App\Models\Activity;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\FileUpload;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables;
use Illuminate\Support\Str;

class ActivityResource extends Resource
{
    protected static ?string $model = Activity::class;
    protected static ?string $navigationIcon = 'heroicon-o-bolt';

    public static function form(Form $form): Form
    {
        return $form->schema([
            TextInput::make('name')
                ->label('Название')
                ->required()
                ->maxLength(50),

            Textarea::make('description')
                ->label('Описание')
                ->maxLength(800)
                ->nullable(),

            Textarea::make('short_description')
                ->label('Краткое описание')
                ->maxLength(200)
                ->nullable(),

            Select::make('source_id')
                ->label('Партнёр')
                ->relationship('participant', 'name')
                ->required(),

            Select::make('activity_type_id')
                ->label('Тип активности')
                ->relationship('activityType', 'name')
                ->required(),

            FileUpload::make('media')
                ->label('Медиа (картинки/видео)')
                ->multiple()
                ->directory('activities/media')
                ->visibility('public')
                ->nullable(),

            TextInput::make('registration_url')
                ->label('Ссылка на регистрацию')
                ->url()
                ->nullable(),

            Textarea::make('location')
                ->label('Локация')
                ->nullable(),

            Textarea::make('coordinates')
                ->label('Координаты (JSON)')
                ->nullable()
                ->dehydrateStateUsing(fn ($state) => is_string($state) ? $state : json_encode($state))
                ->formatStateUsing(fn ($state) => is_array($state) ? json_encode($state, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) : $state)
                ->helperText('Пример: [[55.751244, 37.618423], [55.752244, 37.618423]]'),

            Textarea::make('dates')
                ->label('Даты (JSON)')
                ->nullable()
                ->dehydrateStateUsing(fn ($state) => is_string($state) ? $state : json_encode($state))
                ->formatStateUsing(fn ($state) => is_array($state) ? json_encode($state, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) : $state)
                ->helperText('Пример: [{"start": "2025-08-10T10:00:00", "end": "2025-08-10T16:00:00"}]')
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            TextColumn::make('name')->label('Название')->searchable()->limit(40),
            TextColumn::make('participant.name')->label('Партнёр')->sortable(),
            TextColumn::make('activityType.name')->label('Тип')->sortable(),
            TextColumn::make('short_description')->label('Описание')->limit(50),
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
            ->defaultSort('created_at', 'desc');
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListActivities::route('/'),
            'create' => Pages\CreateActivity::route('/create'),
            'edit' => Pages\EditActivity::route('/{record}/edit'),
        ];
    }
}
