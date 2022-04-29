<?php

namespace App\Models;

use App\Traits\ModelTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Webpatser\Uuid\Uuid;

class Order extends Model
{
    use HasFactory,ModelTrait;

    protected $fillable = ['total_price', 'shipping', 'payment_type', 'order_status'];

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
            $this->getEditButtonAttribute('order.edit') .
            $this->getDeleteButtonAttribute('order.delete') .
            '</ul>';
    }

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
}
