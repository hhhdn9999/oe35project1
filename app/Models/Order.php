<?php

namespace App\Models;
use App\User;
use Eloquent;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'order';
    protected $primaryKey = 'id';
    protected $guarded = [];
    protected $fillable = [
        'user_id',
        'total_price',
        'status',
    ];

    public function user()
    {

        return $this->belongsTo(User::class, 'user_id');
    }

    public function product() {

        return $this->belongsToMany('App\Models\Product', 'order_detail');
    }

    public function orderdetail()
    {
        return $this->belongsTo('App\Models\OrderDetail');
    }
}
