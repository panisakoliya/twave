<?php

namespace App\DataTables;

use App\Models\User;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class UserDatatable extends DataTable
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
            ->addColumn('image', function ($query) {
                return "<img class='small-img' src='" . $query->image_path . "' alt=''>";
            })->addcolumn('action', function ($query) {
                return $query->action_buttons;
            })->rawColumns(['image', 'action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(User $model)
    {
        return $model->newQuery()->role('user');
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('users-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom('<"row"<"col-md-12"<"row"<"col-md-2"l><"col-md-4"B><"col-md-6"f> > ><"col-md-12"rt> <"col-md-12"<"row"<"col-md-5"i><"col-md-7"p>>> >')
            ->orderBy(0, 'asc')
            ->destroy(true)
            ->responsive(true)
            ->serverSide(true)
            ->searching(true)
            ->stateSave(true)
            ->processing(true)
            /*->language(__('app.datatable'))*/
            ->parameters();
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
            'email',
            'address',
            'image',
            'phone_number',
            'action' => [
                'data' => 'action',
                'name' => 'action',
                'title' => 'Actions',
                'exportable' => false,
                'printable' => false,
                'searchable' => false,
                'orderable' => false,
            ],
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Users_' . date('YmdHis');
    }
}
