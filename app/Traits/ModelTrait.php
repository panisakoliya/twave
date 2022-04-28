<?php

namespace App\Traits;

trait ModelTrait
{
    /**
     * @return string
     */
    public function getViewButtonAttribute($route)
    {
        return '<a href=' . route($route, $this) . ' title="View" class="cursor-pointer m-1"><span class="material-icons">remove_red_eye</span></a>';
    }

    /**
     * @return string
     */
    public function getEditButtonAttribute($route)
    {
        return '<a href=' . route($route, $this) . ' title="Edit" class="cursor-pointer m-1"><span class="material-icons">edit</span></a>';
    }

    /**
     * @return string
     */
    public function getDeleteButtonAttribute($route)
    {
        return '<a onclick="deleteRow(' . "'" . route($route) . "'," . "'" . $this->uuid . "'" . ')" href="#" title="Delete" class="cursor-pointer m-1"><span class="material-icons">delete</span></a>';
    }
}
