<?php

namespace App\Filament\Resources;

use App\Filament\Exports\SantriExporter;
use App\Filament\Resources\SantriResource\Pages;
use App\Filament\Resources\SantriResource\Pages\ManageSantris;
use App\Imports\SantriImport;
use App\Models\Santri;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Maatwebsite\Excel\Facades\Excel;
use pxlrbt\FilamentExcel\Actions\Tables\ExportAction as ExcelExportAction;

class SantriResource extends Resource
{
    protected static ?string $model = Santri::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';
    protected static ?string $navigationLabel = 'Data Santri';
    protected static ?string $navigationGroup = 'Data Master';
    protected static ?int $navigationSort = 21;

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::where('status_santri', '!=', 'alumni')->count();
    }

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form->schema([
            TextInput::make('nama')
                ->label('Nama Santri')
                ->required(),

            TextInput::make('nis')
                ->label('NIS')
                ->required(),

            TextInput::make('nik')
                ->label('NIK')
                ->required(),

            TextInput::make('no_kk')
                ->label('NO KK')
                ->required(),

            Select::make('jenis_kelamin')
                ->label('Jenis Kelamin')
                ->required()
                ->options([
                    'Laki-laki' => 'Laki-laki',
                    'Perempuan' => 'Perempuan',
                ]),

            TextInput::make('tempat_lahir')
                ->label('Tempat Lahir')
                ->required(),

            DatePicker::make('tanggal_lahir')
                ->label('Tanggal Lahir')
                ->required(),

            TextInput::make('nama_wali')
                ->label('Nama Wali')
                ->required(),

            // === tambahan field wali ===
            TextInput::make('email_wali')
                ->label('Email Wali')
                ->email()
                ->nullable(),

            DatePicker::make('tanggal_lahir_wali')
                ->label('Tanggal Lahir Wali')
                ->nullable(),

            Textarea::make('alamat_wali')
                ->label('Alamat Wali')
                ->nullable()
                ->columnSpan(2),

            TextInput::make('no_hp_wali')
                ->label('No HP Wali')
                ->tel()
                ->nullable(),
            FileUpload::make('image_wali')   
            ->label('Foto Wali')
            ->image()
            ->directory('wali')
            ->disk('public')
            ->nullable()
            ->columnSpan(2),
            // ============================

            Textarea::make('alamat')
                ->label('Alamat Santri')
                ->required()
                ->columnSpan(2),

            Select::make('kamar_id')
                ->label('Kamar & Rayon')
                ->relationship('kamar', 'nama_kamar')
                ->getOptionLabelFromRecordUsing(function ($record) {
                    return $record->nama_kamar . ' | ' . $record->rayon->nama_rayon;
                })
                ->required()
                ->createOptionForm([
                    TextInput::make('nama_kamar')
                        ->label('Nama Kamar')
                        ->required()
                        ->rules(['required', 'unique:kamar,nama_kamar'])
                        ->validationMessages([
                            'unique' => 'nama kamar sudah terdaftar!',
                        ]),

                    Select::make('rayon_id')
                        ->label('Rayon')
                        ->relationship('rayon', 'nama_rayon')
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
                ]),

            Select::make('persentase_tagihan_id')
                ->label('Jabatan')
                ->relationship('persentase_tagihan', 'jabatan_santri')
                ->required()
                ->createOptionForm([
                    TextInput::make('jabatan_santri')
                        ->label('Tingkat')
                        ->required()
                        ->columnSpan(2),
                    TextInput::make('potongan')
                        ->label('potongan')
                        ->numeric()
                        ->required()
                        ->columnSpan(2),
                    Textarea::make('deskripsi')
                        ->label('Deskripsi')
                        ->required()
                        ->columnSpan(2),
                ]),

            Select::make('periode_id')
                ->label('Periode')
                ->relationship('periode', 'nama_periode')
                ->required()
                ->createOptionForm([
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
                            'alumni' => 'non-aktif'
                        ])
                ]),

            Select::make('hubungan_wali')
                ->label('Hubungan Wali')
                ->options([
                    'Orang Tua' => 'Orang Tua',
                    'Saudara' => 'Saudara',
                    'Lainnya' => 'Lainnya',
                ]),

            Select::make('status_santri')
                ->label('Status Santri')
                ->required()
                ->options([
                    'aktif' => 'Aktif',
                    'non-aktif' => 'Non-Aktif',
                    'alumni' => 'Alumni',
                ])
                ->columnSpan(2),

            FileUpload::make('image')
                ->image()
                ->directory('santri')
                 ->disk('public')
                ->required()
                ->columnSpan(2),
        ]);
    }

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                ImageColumn::make('image')
                    ->circular()
                     ->disk('public')
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('nama')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('nis')
                    ->searchable(),

                TextColumn::make('no_kk')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('nik')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('tempat_lahir'),

                TextColumn::make('tanggal_lahir'),

                TextColumn::make('jenis_kelamin')
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('alamat')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('persentase_tagihan.jabatan_santri')
                    ->label('Jabatan Santri'),

                TextColumn::make('kamar.nama_kamar')
                    ->searchable(),

                TextColumn::make('periode.nama_periode')
                    ->searchable(),

                TextColumn::make('nama_wali'),

                TextColumn::make('hubungan_wali')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('status_santri')
                    ->label('Status Santri')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'aktif' => 'success',
                        'non-aktif' => 'danger',
                        'alumni' => 'warning',
                    }),
            ])

            ->filters([
                SelectFilter::make('santri')
                    ->label('Nama Kamar')
                    ->relationship('kamar', 'nama_kamar'),
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

            ->headerActions([
                Action::make('import')
                    ->label('Import Data')
                    ->action(function (array $data) {
                        if (!isset($data['file']) || !is_string($data['file'])) {
                            throw new \Exception('File tidak diterima oleh sistem. Pastikan Anda sudah mengunggah file yang benar.');
                        }

                        $filePath = $data['file'];
                        if (!file_exists(storage_path('app/public/' . $filePath))) {
                            throw new \Exception('File tidak ditemukan di path: ' . $filePath);
                        }

                        try {
                            $import = new SantriImport();
                            Excel::import(new SantriImport, storage_path('app/public/' . $filePath));

                            Notification::make()
                                ->title('Proses Impor Selesai')
                                ->body("Berhasil mengimpor " . $import->getSuccessCount() . " data, gagal mengimpor " . $import->getFailCount() . " data.")
                                ->success()
                                ->send();
                        } catch (\Exception $e) {
                            Notification::make()
                                ->title('Terjadi Kesalahan')
                                ->body('Proses impor gagal: ' . $e->getMessage())
                                ->danger()
                                ->send();
                        }
                    })
                    ->form([
                        FileUpload::make('file')
                            ->label('File Excel')
                            ->required()
                            ->acceptedFileTypes(['application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'])
                            ->disk('public')
                            ->directory('temp'),
                    ])
                    ->icon('heroicon-o-arrow-up-tray')
                    ->color('danger'),

                Tables\Actions\CreateAction::make()
                    ->label('Add Santri')
                    ->icon('heroicon-o-plus-circle'),

                ExcelExportAction::make()->color('success'),
            ])

            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageSantris::route('/'),
        ];
    }
}
