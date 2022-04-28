<?php

namespace App\Models;

use App\Traits\ModelTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Webpatser\Uuid\Uuid;

class Product extends Model
{
    use HasFactory,ModelTrait;

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->uuid = (string)Uuid::generate(4);
        });
    }

    public function getRouteKeyName()
    {
        return 'uuid';
    }

    public function getActionButtonsAttribute()
    {
        return '<ul class="table-controls m-0 p-0">' .
            $this->getEditButtonAttribute('product.edit') .
            $this->getDeleteButtonAttribute('product.delete') .
            '</ul>';
    }
}


