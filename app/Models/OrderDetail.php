<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    protected $table = 'order_detail';
    protected $primaryKey = 'id';
    protected $guarded = [];
    protected $fillable = [
        'product_id',
        'order_id',
        'order_product_name',
        'order_product_totalprice',
        'quantity',
    ];

    public function order()
    {

        return $this->belongsTo('App\Models\Order', 'order_id');
    }

    public function product()
    {

        return $this->belongsTo('App\Models\Product', 'product_id');
    }
}
