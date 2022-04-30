<?php

namespace App\DataTables;

use App\Models\Product;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ProductDatatable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addColumn('category', function ($query) {
                return $query->category->name ?? '';
            })->addColumn('image', function ($query) {
                return "<img class='small-img' src='" . $query->image_path . "' alt=''>";
            })->addcolumn('action', function ($query) {
                return $query->action_buttons;
            })->rawColumns(['image', 'action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Product $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Product $model)
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('products-table')
            ->addTableClass('table style-3 table-hover dataTable no-footer text-center')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->responsive(true)
            ->orderBy(0)
            ->parameters([
                'dom' => '<"row"<"col-md-12"<"row"<"col-md-2"l><"col-md-4"B><"col-md-6"f> > ><"col-md-12"rt> <"col-md-12"<"row"<"col-md-5"i><"col-md-7"p>>> >',
                'buttons' => [
                    'buttons' => [
                        ['extend' => 'copy', 'className' => 'btn'],
                        ['extend' => 'csv', 'className' => 'btn', 'exportOptions' => ['columns' => [1, 2, 3, 4, 5, 6]]],
                        ['extend' => 'excel', 'className' => 'btn', 'exportOptions' => ['columns' => [1, 2, 3, 4, 5, 6]]],
                        ['extend' => 'print', 'className' => 'btn', 'exportOptions' => ['columns' => [1, 2, 3, 4, 5, 6]]],
                    ],

                ],
                'oLanguage' => [
                    'oPaginate' => [
                        'sPrevious' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>',
                        'sNext' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>',
                    ],
                    'sInfo' => 'Showing page _PAGE_ of _PAGES_',
                    'sSearch' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
                    'sSearchPlaceholder' => 'Search...',
                    'sLengthMenu' => 'Results :  _MENU_',
                ],
                'lengthMenu' => [[10, 25, 50, 100, 200, -1], [10, 25, 50, 100, 200, "All"]],
                'pageLength' => 10,
                'processing' => true,
                'autoWidth' => true,
                'serverSide' => true,
                'responsive' => true,
                'fnDrawCallback' => 'function() {
                    $("[data-bs-toggle=\'tooltip\']").tooltip();
                }',
            ]);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            'id',
            'name',
            'category',
            'price',
            'image',
            'action',
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Product_' . date('YmdHis');
    }
}
