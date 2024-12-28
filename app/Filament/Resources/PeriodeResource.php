<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PeriodeResource\Pages;
use App\Filament\Resources\PeriodeResource\Pages\ManagePeriodes;
use App\Filament\Resources\PeriodeResource\RelationManagers;
use App\Models\Periode;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Pages\Actions\DeleteAction;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PeriodeResource extends Resource
{
    protected static ?string $model = Periode::class;

    protected static ?string $navigationIcon = 'heroicon-o-calendar-days';
    protected static ?string $navigationLabel = 'Periode';
    protected static ?string $navigationGroup = 'Data Referensi';
    protected static ?int $navigationSort = 11 ;

    public static function getNavigationBadge(): ?string{
        return static::getModel()::count();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('kode_periode')
                    ->label('Kode Periode')
                    ->required(),
                TextInput::make('nama_periode')
                    ->label('Nama Periode')
                    ->required(),
                Select::make('status')
                    ->label('Status')
                    ->columnSpan(2)
                    ->options([
                        'aktif' => 'aktif',
                        'non-aktif' => 'non-aktif'
                    ])
                ]);

    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('kode_periode')
                ->searchable(),
                TextColumn::make('nama_periode')
                ->searchable(),
                TextColumn::make('status')
                ->badge()
                ->color(function(string $state):string{
                    return match($state){
                        'aktif'=> 'success',
                        'non-aktif'=> 'danger',
                }; }),
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
            'index' => Pages\ManagePeriodes::route('/'),
        ];
    }
}
