<?php

namespace App\Models;

use App\Traits\ModelTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Webpatser\Uuid\Uuid;

class Category extends Model
{
    use HasFactory, ModelTrait;

    protected $fillable = ['image', 'name'];

    /**
     *  Setup model event hooks
     */
    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->uuid = (string)Uuid::generate(4);
        });
    }

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'uuid';
    }

    public function getActionButtonsAttribute()
    {
        return '<ul class="table-controls m-0 p-0">' .
            $this->getEditButtonAttribute('category.edit') .
            $this->getDeleteButtonAttribute('category.delete') .
            '</ul>';
    }

    public function getImagePathAttribute()
    {
        return asset('assets/images/category_images') . '/' . $this->image;
    }
}
