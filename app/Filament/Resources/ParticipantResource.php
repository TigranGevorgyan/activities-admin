<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ParticipantResource\Pages;
use App\Models\Participant;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables;
use Illuminate\Support\Str;

class ParticipantResource extends Resource
{
    protected static ?string $model = Participant::class;
    protected static ?string $navigationIcon = 'heroicon-o-users';

    public static function form(Form $form): Form
    {
        return $form->schema([
            TextInput::make('name')
                ->label('Название партнёра')
                ->required()
                ->maxLength(255),

            TextInput::make('website_url')
                ->label('Сайт')
                ->url()
                ->nullable(),

            FileUpload::make('logo')
                ->label('Логотип')
                ->directory('participants/logos')
                ->image()
                ->visibility('public')
                ->maxSize(4096)
                ->nullable(),

            Textarea::make('location')
                ->label('Локация')
                ->nullable(),

            Textarea::make('coordinates')
                ->label('Координаты (JSON)')
                ->dehydrateStateUsing(fn ($state) => is_string($state) ? $state : json_encode($state))
                ->formatStateUsing(fn ($state) => is_array($state) ? json_encode($state, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) : $state)
                ->nullable(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->label('Имя')->searchable(),
                TextColumn::make('website_url')->label('Сайт')->limit(30)->url(
                    fn (?string $state) => Str::startsWith($state, 'http') ? $state : "https://{$state}"
                ),
                ImageColumn::make('logo')->label('Логотип'),
                TextColumn::make('location')->label('Локация')->limit(30),
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
            ->defaultSort('name');
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListParticipants::route('/'),
            'create' => Pages\CreateParticipant::route('/create'),
            'edit' => Pages\EditParticipant::route('/{record}/edit'),
        ];
    }
}
