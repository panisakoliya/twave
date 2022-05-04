<?php

namespace App\Traits;

use App\Models\Add;

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
        return '<a onclick="deleteRow(' . "'" . route($route, $this) . "'" . ')" href="#" title="Delete" class="cursor-pointer m-1"><span class="material-icons">delete</span></a>';
    }


    /**
     * @return string
     */
    public function getSubEditButtonAttribute($route, $firstParam)
    {
        return '<a href=' . route($route, [$firstParam, $this]) . ' title="Edit" class="cursor-pointer m-1"><span class="material-icons">edit</span></a>';
    }

    /**
     * @return string
     */
    public function getSubDeleteButtonAttribute($route, $firstParam)
    {
        return '<a onclick="deleteRow(' . "'" . route($route, [$firstParam, $this]) . "'" . ')" href="#" title="Delete" class="cursor-pointer m-1"><span class="material-icons">delete</span></a>';
    }
}
