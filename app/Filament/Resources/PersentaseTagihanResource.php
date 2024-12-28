<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PersentaseTagihanResource\Pages;
use App\Filament\Resources\PersentaseTagihanResource\Pages\ManagePersentaseTagihans;
use App\Filament\Resources\PersentaseTagihanResource\RelationManagers;
use App\Models\PersentaseTagihan;
use Filament\Forms;
use Filament\Forms\Components\Textarea;
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

class PersentaseTagihanResource extends Resource
{
    protected static ?string $model = PersentaseTagihan::class;

    protected static ?string $navigationIcon = 'heroicon-o-scale';
    protected static ?string $navigationLabel = 'Persentase';
    protected static ?string $navigationGroup = 'Management Keuangan';
    protected static ?int $navigationSort = 31 ;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('jabatan_santri')
                        ->label('Tingkat')
                        ->required()
                        ->columnSpan(2),
                TextInput::make('potongan')
                        ->label('potongan')
                        ->required()
                        ->formatStateUsing(fn($state) => intval($state))
                        ->columnSpan(2),
                Textarea::make('deskripsi')
                        ->label('Deskripsi')
                        ->required()
                        ->columnSpan(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('no')
                    ->label('No.')
                    ->rowIndex(),
                TextColumn::make('jabatan_santri')
                ->searchable(),
                TextColumn::make('potongan')
                    ->label('Potongan (%)')
                    ->formatStateUsing(fn($state) => intval($state). '%'),
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
            'index' => Pages\ManagePersentaseTagihans::route('/'),
        ];
    }
}
