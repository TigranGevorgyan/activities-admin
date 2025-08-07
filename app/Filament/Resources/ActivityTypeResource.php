<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ActivityTypeResource\Pages;
use App\Models\ActivityType;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables;

class ActivityTypeResource extends Resource
{
    protected static ?string $model = ActivityType::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->label('Название')
                    ->required()
                    ->maxLength(255),

                FileUpload::make('icon')
                    ->label('Картинка/иконка')
                    ->image()
                    ->directory('activity-types/icons')
                    ->visibility('public')
                    ->maxSize(5120), // 5MB

                TextInput::make('order')
                    ->label('Порядок показа')
                    ->numeric()
                    ->default(0),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->label('Название'),
                ImageColumn::make('icon')->label('Иконка'),
                TextColumn::make('order')->label('Порядок'),
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
            ->defaultSort('order');
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
            'index' => Pages\ListActivityTypes::route('/'),
            'create' => Pages\CreateActivityType::route('/create'),
            'edit' => Pages\EditActivityType::route('/{record}/edit'),
        ];
    }
}
