<?php

namespace App\Filament\Exports;

use App\Models\Sale;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;

class SaleExporter extends Exporter
{
    protected static ?string $model = Sale::class;

    public static function getColumns(): array
    {
        return [
            // Columnas básicas de la venta
            ExportColumn::make('contract')
                ->label('No. Contrato'),
            ExportColumn::make('user.name')
                ->label('Usuario'),
            ExportColumn::make('created_at')
                ->label('Fecha de creación')
                ->formatStateUsing(fn ($state) => $state->format('d/m/Y')),
                
            // Columnas del detalle de venta
            ExportColumn::make('detail_sale.year')
                ->label('Año')
                ->formatStateUsing(fn ($state) => $state ? $state->format('d/m/Y') : 'N/A'),
            ExportColumn::make('detail_sale.ops.name')
                ->label('OPS'),
            ExportColumn::make('detail_sale.inconterm.name')
                ->label('Incoterms'),
            ExportColumn::make('detail_sale.supplier.name')
                ->label('Suplidor'),
            ExportColumn::make('detail_sale.shipper.name')
                ->label('Embarcador'),
            ExportColumn::make('detail_sale.third')
                ->label('Tercero'),
            ExportColumn::make('detail_sale.buque')
                ->label('Buque'),
            ExportColumn::make('detail_sale.from')
                ->label('Fecha inicial')
                ->formatStateUsing(fn ($state) => $state ? $state->format('d/m/Y') : 'N/A'),
            ExportColumn::make('detail_sale.to')
                ->label('Fecha final')
                ->formatStateUsing(fn ($state) => $state ? $state->format('d/m/Y') : 'N/A'),
            ExportColumn::make('detail_sale.ETA')
                ->label('ETA')
                ->formatStateUsing(fn ($state) => $state ? $state->format('d/m/Y') : 'N/A'),
            ExportColumn::make('detail_sale.BL')
                ->label('Fecha BL')
                ->formatStateUsing(fn ($state) => $state ? $state->format('d/m/Y') : 'N/A'),
            ExportColumn::make('detail_sale.material.name')
                ->label('Material'),
            ExportColumn::make('detail_sale.type.name')
                ->label('Tipo'),
            ExportColumn::make('detail_sale.size.name')
                ->label('Tamaño'),
            ExportColumn::make('detail_sale.port.name')
                ->label('Puerto'),
            ExportColumn::make('detail_sale.discharge_port.name')
                ->label('Puerto de descarga'),
            ExportColumn::make('detail_sale.destination_country.name')
                ->label('País de destino'),
            ExportColumn::make('detail_sale.tm')
                ->label('Toneladas métricas'),
            ExportColumn::make('detail_sale.sale_state.name')
                ->label('Estado de venta'),
            ExportColumn::make('detail_sale.lab.name')
                ->label('Laboratorio'),
            ExportColumn::make('detail_sale.agency.name')
                ->label('Agencia'),
            ExportColumn::make('detail_sale.second_state.name')
                ->label('Estado secundario'),
            ExportColumn::make('detail_sale.load_rate')
                ->label('Tarifa de carga'),
            ExportColumn::make('detail_sale.OVH')
                ->label('OVH')
                ->formatStateUsing(fn ($state) => $state ? 'Sí' : 'No'),
        ];
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = 'Your sale export has completed and ' . number_format($export->successful_rows) . ' ' . str('row')->plural($export->successful_rows) . ' exported.';

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to export.';
        }

        return $body;
    }
}
