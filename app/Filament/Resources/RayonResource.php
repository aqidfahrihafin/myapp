<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RayonResource\Pages;
use App\Filament\Resources\RayonResource\Pages\ManageRayons;
use App\Filament\Resources\RayonResource\RelationManagers;
use App\Models\Rayon;
use Filament\Actions\EditAction;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Pages\Actions\DeleteAction;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class RayonResource extends Resource
{
    protected static ?string $model = Rayon::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-group';
    protected static ?string $navigationLabel = 'Rayon';
    protected static ?string $navigationGroup = 'Data Referensi';
    protected static ?int $navigationSort = 12 ;

    public static function getNavigationBadge(): ?string{
        return static::getModel()::count();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                FileUpload::make('image')
                ->image()
                ->directory('rayons')
                ->required()
                ->columnSpan(2),
                TextInput::make('nama_rayon')
                ->rules(['required', 'unique:rayon,nama_rayon'])
                ->validationMessages([
                    'unique' => 'nama rayon sudah terdaftar!',
                ])
                 ->columnSpan(2),
                TextInput::make('deskripsi')
                 ->columnSpan(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('image')
                ->circular(),
                TextColumn::make('nama_rayon')
                ->searchable(),
                TextColumn::make('deskripsi'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make()
                    ->icon('heroicon-o-eye')
                    ->label(''),
                Tables\Actions\EditAction::make()
                    ->icon('heroicon-o-pencil')
                    ->label(''),
                Tables\Actions\DeleteAction::make()
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
            'index' => Pages\ManageRayons::route('/'),
        ];
    }
}
