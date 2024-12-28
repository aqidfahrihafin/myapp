<?php

namespace App\Filament\Resources;

use App\Filament\Resources\KamarResource\Pages;
use App\Filament\Resources\KamarResource\Pages\ManageKamars;
use App\Filament\Resources\KamarResource\RelationManagers;
use App\Models\Kamar;
use Filament\Actions\EditAction;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Pages\Actions\DeleteAction;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class KamarResource extends Resource
{
    protected static ?string $model = Kamar::class;

    protected static ?string $navigationIcon = 'heroicon-o-home-modern';
    protected static ?string $navigationLabel = 'Kamar';
    protected static ?string $navigationGroup = 'Data Referensi';
    protected static ?int $navigationSort = 13 ;

    public static function getNavigationBadge(): ?string{
        return static::getModel()::count();
    }

    public static function form(Form $form): Form
    {
        return $form
        ->schema([
            TextInput::make('nama_kamar')
                ->label('Nama Kamar')
                ->rules(['required', 'unique:kamar,nama_kamar'])
                ->validationMessages([
                    'unique' => 'nama kamar sudah terdaftar!',
                ])
                ->required(),

            Select::make('rayon_id')
                ->label('Rayon')
                ->relationship('rayon', 'nama_rayon')
                // ->searchable() // Opsional:
                ->required()
                ->createOptionForm([
                    FileUpload::make('image')
                    ->image()
                    ->directory('rayons')
                    ->required()
                    ->columnSpan(2),
                    TextInput::make('nama_rayon')
                        ->label('Nama Rayon')
                        ->required()
                        ->columnSpan(2),
                    Textarea::make('deskripsi')
                        ->label('Deskripsi Rayon')
                        ->required()
                        ->columnSpan(2),
                ]),

            TextInput::make('kapasitas')
                ->label('Kapasitas')
                ->numeric()
                ->required()
                ->columnSpan(2),

            Textarea::make('deskripsi')
                ->label('Deskripsi')
                ->nullable()
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
                TextColumn::make('rayon.nama_rayon'),
                TextColumn::make('nama_kamar')
                ->searchable(),
                TextColumn::make('kapasitas')
                ->label('Kapasitas')
                ->formatStateUsing(fn ($state) => $state . ' santri'),
                TextColumn::make('deskripsi')
                    ->limit(5)
                    ->tooltip(function (TextColumn $column): ?string {
                        $state = $column->getState();
                        if (strlen($state) <= $column->getCharacterLimit()) {
                            return null;
                        }
                        return $state;
                    }),
            ])

            ->filters([
               SelectFilter::make('kamar')
               ->label('Rayon')
               ->relationship('rayon', 'nama_rayon'),
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
            'index' => Pages\ManageKamars::route('/'),
        ];
    }

    public static function getLabel(): ?string{
        $locale =app()->getLocale();
        if($locale =='id'){
            return "Kamar";
        }else
        return "Room";
    }
}
