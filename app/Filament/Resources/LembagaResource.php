<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LembagaResource\Pages;
use App\Filament\Resources\LembagaResource\Pages\ManageLembagas;
use App\Filament\Resources\LembagaResource\RelationManagers;
use App\Models\Lembaga;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Actions;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;


class LembagaResource extends Resource
{
    protected static ?string $model = Lembaga::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-office';
    protected static ?string $navigationLabel = 'Lembaga';
    protected static ?string $navigationGroup = 'Data Referensi';
    protected static ?int $navigationSort = 10;

    public static function getNavigationBadge(): ?string {
        return static::getModel()::count();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                FileUpload::make('image')
                    ->image()
                    ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/jpg', 'image/gif'])
                    ->directory('lembaga')
                    ->required()
                    ->columnSpan(2),
                TextInput::make('nama_lembaga')
                    ->columnSpan(2)
                    ->required(),
                TextInput::make('nsm')
                    ->columnSpan(2),
                TextInput::make('npsm')
                    ->columnSpan(2),
                TextInput::make('kecamatan')
                    ->columnSpan(2),
                TextInput::make('kabupaten')
                    ->columnSpan(2),
                TextInput::make('provinsi')
                    ->columnSpan(2),
                TextInput::make('alamat')
                    ->columnSpan(2),
                TextInput::make('nama_pinpinan')
                    ->columnSpan(2),
                TextInput::make('nip')
                    ->columnSpan(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('image')
                    ->circular(),
                TextColumn::make('nama_lembaga')
                    ->searchable(),
                TextColumn::make('nsm'),
                TextColumn::make('npsm'),
                TextColumn::make('kabupaten'),
                TextColumn::make('provinsi'),
                TextColumn::make('kecamatan'),
                TextColumn::make('alamat'),
                TextColumn::make('nama_pinpinan'),
            ])
            ->filters([])
            ->actions([
                Actions\ViewAction::make()
                    ->icon('heroicon-o-eye')
                    ->label(''),
                Actions\EditAction::make()
                    ->icon('heroicon-o-pencil')
                    ->label(''),
                Actions\DeleteAction::make()
                    ->icon('heroicon-o-trash')
                    ->label(''),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageLembagas::route('/'),
        ];
    }
}
