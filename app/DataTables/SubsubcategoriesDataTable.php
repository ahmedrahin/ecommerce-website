<?php

namespace App\DataTables;

use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use App\Models\Subsubcategory;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;
use Illuminate\Support\Facades\Cache;

class SubsubcategoriesDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addIndexColumn()
            ->editColumn('name', function (Subsubcategory $subsubcategory) {
                return $subsubcategory->name;
            })
            ->addColumn('subcategory_name', function (Subsubcategory $subsubcategory) {
                return $subsubcategory->subcategory->name;
            })
            ->addColumn('category_name', function (Subsubcategory $subsubcategory) {
                return $subsubcategory->subcategory->category->name;
            })
            ->addColumn('actions', function (Subsubcategory $subsubcategory) {
                return view('pages.apps.subsubcategory.columns._actions', compact('subsubcategory'));
            })
            ->orderColumn('id', 'id $1')
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Subsubcategory $model): QueryBuilder
    {
        $cacheKey = config('dbcachekey.subsubcategory');
    
        // Retrieve data from cache or execute the query and cache the results
        $subsubcategories = Cache::rememberForever($cacheKey, function () use ($model) {
            return $model->newQuery()
                ->with('subcategory.category')
                ->orderByDesc('id')
                ->get();
        });
        
        return $model->newQuery()->whereIn('id', $subsubcategories->pluck('id'));
    }
    

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('subsubcategory-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom('rt<"row"<"col-sm-12 col-md-5"l><"col-sm-12 col-md-7"p>>')
            ->buttons([
                [
                    'extend' => 'copy',
                    'exportOptions' => ['columns' => ':not(.no-export)']
                ],
                [
                    'extend' => 'excel',
                    'exportOptions' => ['columns' => ':not(.no-export)']
                ],
                [
                    'extend' => 'csv',
                    'exportOptions' => ['columns' => ':not(.no-export)']
                ],
                [
                    'extend' => 'pdf',
                    'exportOptions' => ['columns' => ':not(.no-export)'],
                ],
            ])
            ->addTableClass('table align-middle table-row-dashed fs-6 gy-5 dataTable no-footer text-gray-600 fw-semibold')
            ->setTableHeadClass('text-start text-muted fw-bold fs-7 text-uppercase gs-0')
            ->orderBy(1, 'desc')
            ->drawCallback("function() {" . file_get_contents(resource_path('views/pages/apps/subsubcategory/columns/_draw-scripts.js')) . "}");
    }
    
    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::computed('DT_RowIndex')->title('ID')->addClass('text-center')->orderable(false)->searchable(false),
            Column::make('name')->title('Subsubcategory'),
            Column::computed('subcategory_name')
                ->title('Subcategory')
                ->orderable(false)
                ->searchable(false),
            Column::computed('category_name')
                ->title('Category')
                ->orderable(false)
                ->searchable(false),
            Column::computed('actions')
                ->title('Actions')
                ->addClass('text-end text-nowrap no-export')
                ->exportable(false)
                ->printable(false),
        ];
    }
    
    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Subsubcategories_' . date('YmdHis');
    }
}
