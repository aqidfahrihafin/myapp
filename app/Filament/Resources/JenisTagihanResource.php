<?php

namespace App\Filament\Resources;

use App\Filament\Resources\JenisTagihanResource\Pages;
use App\Filament\Resources\JenisTagihanResource\Pages\ManageJenisTagihans;
use App\Filament\Resources\JenisTagihanResource\RelationManagers;
use App\Models\JenisTagihan;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class JenisTagihanResource extends Resource
{
    protected static ?string $model = JenisTagihan::class;

    protected static ?string $navigationIcon = 'heroicon-o-bookmark-square';
    protected static ?string $navigationLabel = 'Jenis Tagihan';
    protected static ?string $navigationGroup = 'Data Referensi';
    protected static ?int $navigationSort = 12 ;

    public static function getNavigationBadge(): ?string{
        return static::getModel()::count();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                 TextInput::make('nama_jenis')
                 ->columnSpan(2),
                TextInput::make('deskripsi')
                 ->columnSpan(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nama_jenis')
                ->searchable(),
                TextColumn::make('deskripsi'),
            ])
            ->filters([
                //
            ])
            ->actions([
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
            'index' => Pages\ManageJenisTagihans::route('/'),
        ];
    }
}
