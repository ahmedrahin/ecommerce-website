<?php

namespace App\DataTables;

use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use App\Models\Product;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;
use Illuminate\Support\Facades\Cache;

class ProductsDataTable extends DataTable
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
            ->editColumn('name', function (Product $product) {
                $url = route('product-management.show', $product->id);
                $imagePath = $product->thumb_image ? $product->thumb_image : 'uploads/blank-image.svg'; 
                $imageUrl = asset($imagePath);
                $pName = '<a target="_blank" class="text-gray-800 text-hover-primary fs-5 fw-bold" href="' . $url . '">';
                $pName .= '<img src="' . asset($imageUrl) . '" alt="' . $product->name . '" width="50" height="50" class="table-product-image" style="object-fit: cover; margin-right: 10px;">';
                $pName .= $product->name . '</a>';
                return $pName;
            })
            ->editColumn('base_price', function (Product $product) {
                if ($product->discount_option == 1) {
                    return ($product->base_price) . '৳';
                } else {
                    return ($product->offer_price) . '৳' . '<br><del style="color: #f1416cad">' . ($product->base_price) . '৳' . '</del>';
                }
            })
            ->editColumn('offer_price', function (Product $product) {
                return $product->offer_price;
            })
            ->editColumn('sku_code', function (Product $product) {
                return $product->sku_code;
            })
            ->editColumn('quantity', function (Product $product) {
                if ($product->quantity == 0) {
                    return '<span class="badge badge-light-danger">Sold out</span>';
                } elseif ($product->quantity > 0 && $product->quantity <= 5) {
                    return '<span class="badge badge-light-warning">Low stock: ' . $product->quantity . '</span>';
                } else {
                    return '<span class="badge badge-light-primary">' . $product->quantity . '</span>';
                }
            })
            ->editColumn('category_id', function (Product $product) {
                return optional($product->category)->name ?? '<span class="badge badge-light-danger">Uncategorized</span>';
            })
            ->addColumn('rating', function (Product $product) {
                $reviews = '<div class="rating justify-content-center">
                            <div class="rating-label checked"><i class="ki-duotone ki-star fs-6"></i></div>
                            <div class="rating-label checked"><i class="ki-duotone ki-star fs-6"></i></div>
                            <div class="rating-label checked"><i class="ki-duotone ki-star fs-6"></i></div>
                            <div class="rating-label checked"><i class="ki-duotone ki-star fs-6"></i></div>
                            <div class="rating-label"><i class="ki-duotone ki-star fs-6"></i></div>
                        </div>';
                return $reviews;
            })
            ->addColumn('status', function (Product $product) {
                return view('pages.apps.product.columns._active_status', compact('product'));
            })
            ->filterColumn('category_id', function ($query, $keyword) {
                $query->whereHas('category', function ($q) use ($keyword) {
                    $q->where('name', 'like', "%$keyword%");
                });
            })

            ->addColumn('actions', function (Product $product) {
                return view('pages.apps.product.columns._actions', compact('product'));
            })
            ->orderColumn('id', 'id $1')
            ->setRowId('id')
            ->rawColumns(['name', 'base_price', 'quantity', 'category_id', 'rating', 'actions']);
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Product $model): QueryBuilder
    {
        $cacheKey = config('dbcachekey.product');
        $products = Cache::rememberForever($cacheKey, function () use ($model) {
            return $model->newQuery()
                         ->orderBy('id', 'desc')
                         ->get();
        });
    
        $ids = $products->pluck('id')->toArray();
        return $model->newQuery()->whereIn('id', $ids)->orderBy('id', 'desc');
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('product-table')
            ->columns($this->getColumns())
            
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
            ->drawCallback("function() {" . file_get_contents(resource_path('views/pages/apps/product/columns/_draw-scripts.js')) . "}");
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::computed('DT_RowIndex')->title('ID')->addClass('text-center'),
            Column::make('name')->title('Name'),
            Column::make('base_price')->title('Price')->addClass('text-center'),
            Column::make('offer_price')->visible(false),
            Column::make('sku_code')->title('Sku_code')->addClass('text-center'),
            Column::make('quantity')->title('Qty')->addClass('text-center'),
            Column::make('category_id')->title('Category')->addClass('text-center'),
            Column::computed('rating')->title('Rating')->addClass('text-center'),
            Column::computed('status')
                ->title('Status')
                ->addClass('text-center text-nowrap no-export') 
                ->exportable(false)
                ->printable(false),
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
        return 'Product_' . date('YmdHis');
    }
}
