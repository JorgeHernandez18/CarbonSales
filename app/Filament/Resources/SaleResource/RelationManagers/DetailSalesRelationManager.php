<?php

namespace App\Filament\Resources\SaleResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Components\Wizard;
use Filament\Forms\Components\Wizard\Step;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Support\Enums\MaxWidth;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;
class DetailSalesRelationManager extends RelationManager
{
    protected static string $relationship = 'detail_sale';
    protected static bool $canCreateAnother = false;
    
    // Definir si la venta está cerrada para controlar la edición
    protected function isEditable(Model $record): bool
    {
        // Si la venta está asentada (state = 1), no se permite edición
        return !$this->getOwnerRecord()->state;
    }

    // Verificar si ya existe un detalle de venta para esta venta
    protected function hasDetailSale(): bool
    {
        return $this->getOwnerRecord()->detail_sale()->exists();
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Wizard::make([
                    Step::make('Información básica')
                        ->icon('heroicon-o-document-text')
                        ->description('Datos principales de la venta')
                        ->schema([
                            Forms\Components\Grid::make(2)
                                ->schema([
                                    Forms\Components\DatePicker::make('year')
                                        ->label('Año')
                                        ->nullable(),
                                    Forms\Components\Select::make('ops_id')
                                        ->label('OPS')
                                        ->relationship('ops', 'name')
                                        ->placeholder('Seleccione un ops')
                                        ->searchable()
                                        ->preload()
                                        ->nullable(),
                                ]),
                            Forms\Components\Grid::make(2)
                                ->schema([
                                    Forms\Components\Select::make('inconterm_id')
                                        ->label('Inconterms')
                                        ->relationship('inconterm', 'name')
                                        ->placeholder('Seleccione un inconterm')
                                        ->searchable()
                                        ->preload()
                                        ->nullable(),
                                    Forms\Components\Select::make('supplier_id')
                                        ->relationship('supplier', 'name')
                                        ->placeholder('Seleccione un suplidor')
                                        ->label('Suplidor')
                                        ->searchable()
                                        ->preload()
                                        ->nullable(),
                                ]),
                            Forms\Components\Grid::make(2)
                                ->schema([
                                    Forms\Components\Select::make('shipper_id')
                                        ->relationship('shipper', 'name')
                                        ->placeholder('Seleccione un Embarcador')
                                        ->label('Embarcador')
                                        ->searchable()
                                        ->preload()
                                        ->nullable(),
                                    Forms\Components\TextInput::make('third')
                                        ->label('Tercero')
                                        ->nullable(),
                                ]),
                            Forms\Components\Grid::make(1)
                                ->schema([
                                    Forms\Components\TextInput::make('buque')
                                        ->label('Buque')
                                        ->nullable(),
                                ]),
                        ]),
                    
                    Step::make('Fechas y material')
                        ->icon('heroicon-o-calendar')
                        ->description('Fechas y detalles del material')
                        ->schema([
                            Forms\Components\Grid::make(2)
                                ->schema([
                                    Forms\Components\DatePicker::make('from')
                                        ->label('Fecha inicial')
                                        ->nullable(),
                                    Forms\Components\DatePicker::make('to')
                                        ->label('Fecha final')
                                        ->nullable(),
                                ]),
                            Forms\Components\Grid::make(2)
                                ->schema([
                                    Forms\Components\DatePicker::make('ETA')
                                        ->label('ETA')
                                        ->nullable(),
                                    Forms\Components\DatePicker::make('BL')
                                        ->label('Fecha BL')
                                        ->nullable(),
                                ]),
                            Forms\Components\Grid::make(2)
                                ->schema([
                                    Forms\Components\Select::make('material_id')
                                        ->relationship('material', 'name')
                                        ->placeholder('Seleccione un material')
                                        ->searchable()
                                        ->preload()
                                        ->nullable(),
                                    Forms\Components\Select::make('type_id')
                                        ->relationship('type', 'name')
                                        ->placeholder('Seleccione un tipo')
                                        ->label('Tipo')
                                        ->searchable()
                                        ->preload()
                                        ->nullable(),
                                ]),
                            Forms\Components\Grid::make(1)
                                ->schema([
                                    Forms\Components\Select::make('size_id')
                                        ->relationship('size', 'name')
                                        ->placeholder('Seleccione un tamaño')
                                        ->label('Tamaño')
                                        ->searchable()
                                        ->preload()
                                        ->nullable(),
                                ]),
                        ]),
                        
                    Step::make('Destino y puertos')
                        ->icon('heroicon-o-globe-alt')
                        ->description('Información de puertos y destino')
                        ->schema([
                            Forms\Components\Grid::make(2)
                                ->schema([
                                    Forms\Components\Select::make('port_id')
                                        ->relationship('port', 'name')
                                        ->placeholder('Seleccione un puerto')
                                        ->label('Puerto')
                                        ->searchable()
                                        ->preload()
                                        ->nullable(),
                                    Forms\Components\Select::make('discharge_port_id')
                                        ->relationship('discharge_port', 'name')
                                        ->placeholder('Seleccione un puerto de descarga')
                                        ->label('Puerto de descarga')
                                        ->searchable()
                                        ->preload()
                                        ->nullable(),
                                ]),
                            Forms\Components\Grid::make(2)
                                ->schema([
                                    Forms\Components\Select::make('destination_country_id')
                                        ->relationship('destination_country', 'name')
                                        ->placeholder('Seleccione un país de destino')
                                        ->label('País de destino')
                                        ->searchable()
                                        ->preload()
                                        ->nullable(),
                                    Forms\Components\TextInput::make('tm')
                                        ->label('Toneladas')
                                        ->numeric()
                                        ->nullable(),
                                ]),
                        ]),
                        
                    Step::make('Estados y laboratorio')
                        ->icon('heroicon-o-beaker')
                        ->description('Estados de la venta y laboratorio')
                        ->schema([
                            Forms\Components\Grid::make(2)
                                ->schema([
                                    Forms\Components\Select::make('sale_state_id')
                                        ->relationship('sale_state', 'name')
                                        ->placeholder('Seleccione un estado de venta')
                                        ->label('Estado de venta')
                                        ->searchable()
                                        ->preload()
                                        ->nullable(),
                                    Forms\Components\Select::make('lab_id')
                                        ->relationship('lab', 'name')
                                        ->placeholder('Seleccione un laboratorio')
                                        ->label('Laboratorio')
                                        ->searchable()
                                        ->preload()
                                        ->nullable(),
                                ]),
                            Forms\Components\Grid::make(2)
                                ->schema([
                                    Forms\Components\Select::make('agency_id')
                                        ->relationship('agency', 'name')
                                        ->placeholder('Seleccione una agencia')
                                        ->label('Agencia')
                                        ->searchable()
                                        ->preload()
                                        ->nullable(),
                                    Forms\Components\Select::make('second_state_id')
                                        ->relationship('second_state', 'name')
                                        ->placeholder('Seleccione un estado secundario')
                                        ->label('Estado secundario')
                                        ->searchable()
                                        ->preload()
                                        ->nullable(),
                                ]),
                        ]),
                        
                    Step::make('Tarifas y otros')
                        ->icon('heroicon-o-currency-dollar')
                        ->description('Tarifas y configuraciones adicionales')
                        ->schema([
                            Forms\Components\Grid::make(2)
                                ->schema([
                                    Forms\Components\TextInput::make('load_rate')
                                        ->label('Tarifa de carga')
                                        ->numeric()
                                        ->nullable(),
                                    Forms\Components\Toggle::make('OVH')
                                        ->label('OVH')
                                        ->nullable()
                                        ->inline(false),
                                ]),
                            // Espacio para campos adicionales
                        ]),
                ])->skippable()
                  ->maxWidth('full') // Aumentamos el ancho del wizard
            ])->columns(1); //Propiedad para que el wizard ocupe toda la pantalla del modal
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('id')
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label('ID')
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('ops.name')
                    ->label('OPS'),
                Tables\Columns\TextColumn::make('supplier.name')
                    ->label('Suplidor'),
                Tables\Columns\TextColumn::make('shipper.name')
                    ->label('Embarcador')
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('material.name')
                    ->label('Material'),
                Tables\Columns\TextColumn::make('from')
                    ->label('Desde')
                    ->date(),
                Tables\Columns\TextColumn::make('to')
                    ->label('Hasta')
                    ->date()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('tm')
                    ->label('TM')
                    ->numeric(),
                Tables\Columns\TextColumn::make('sale_state.name')
                    ->label('Estado de venta'),
                Tables\Columns\IconColumn::make('OVH')
                    ->boolean()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                /* Tables\Filters\SelectFilter::make('sale_state_id')
                    ->relationship('sale_state', 'name')
                    ->label('Estado de venta'), */
                Tables\Filters\SelectFilter::make('supplier_id')
                    ->relationship('supplier', 'name')
                    ->label('Suplidor'),
                Tables\Filters\SelectFilter::make('material_id')
                    ->relationship('material', 'name')
                    ->label('Material'),
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()
                    ->modalWidth('3xl')
                    ->successNotification(
                        Notification::make()
                            ->success()
                            ->title('Detalle guardado')
                            ->body('El detalle de venta se ha guardado parcialmente.'),
                    ),
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    //->visible(fn (Model $record): bool => $this->isEditable($record))
                    ->modalWidth('3xl'),
                Tables\Actions\DeleteAction::make()
                    //->visible(fn (Model $record): bool => $this->isEditable($record)),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        //->visible(fn (): bool => !$this->getOwnerRecord()->state),
                ]),
            ])
            ->emptyStateHeading('Sin detalle de venta')
            ->emptyStateDescription('Esta venta aún no tiene un detalle asociado.')
            ->emptyStateIcon('heroicon-o-document-text');
    }
}
