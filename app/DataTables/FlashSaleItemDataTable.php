<?php

namespace App\DataTables;

use App\Models\FlashSaleItem;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class FlashSaleItemDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', function ($query) {

                $deleteBtn = "<a href='" . route('admin.flash-sale-item.delete', $query->id) . "' class= 'btn btn-danger ml-3 delete-item'><i class='fas fa-trash'></i> </a>";

                return $deleteBtn;
            })

            ->addColumn('status', function ($query) {
                if ($query->status == 1) {
                    $button = '<label class="custom-switch">
            <input type="checkbox" checked name="custom-switch-checkbox" data-id = "' . $query->id . '"class="custom-switch-input change-status">
            <span class="custom-switch-indicator"></span>
          </label>';
                } else {
                    $button = '<label class="custom-switch">
            <input type="checkbox" name="custom-switch-checkbox" data-id = "' . $query->id . '"class="custom-switch-input change-status">
            <span class="custom-switch-indicator"></span>
          </label>';
                }
                return $button;
            })

            ->addColumn('show_at_home', function ($query) {
                if ($query->show_at_home == 1) {
                    $button = '<label class="custom-switch">
            <input type="checkbox" checked name="custom-switch-checkbox" data-id = "' . $query->id . '"class="custom-switch-input show-at-home-status">
            <span class="custom-switch-indicator"></span>
          </label>';
                } else {
                    $button = '<label class="custom-switch">
            <input type="checkbox" name="custom-switch-checkbox" data-id = "' . $query->id . '"class="custom-switch-input show-at-home-status">
            <span class="custom-switch-indicator"></span>
          </label>';
                }

                return $button;
            })

            ->addColumn('product_name', function ($query) {
                return "<a href='".route('admin.products.edit', $query->product->id)."'>".$query->product->name."</a>" ;
            })

            ->rawColumns(['action', 'status', 'show_at_home', 'product_name'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(FlashSaleItem $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('flashsaleitem-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            //->dom('Bfrtip')
            ->orderBy(0)
            ->selectStyleSingle()
            ->buttons([
                Button::make('excel'),
                Button::make('csv'),
                Button::make('pdf'),
                Button::make('print'),
                Button::make('reset'),
                Button::make('reload')
            ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::make('id'),
            Column::make('product_name'),
            Column::make('show_at_home'),
            Column::make('status'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(300)
                ->addClass('text-center'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'FlashSaleItem_' . date('YmdHis');
    }
}
