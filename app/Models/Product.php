<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'product';
    protected $primaryKey = 'id';
    protected $guarded = [];
    protected $fillable = [
        'product_name',
        'product_img',
        'description',
        'price',
        'categories',
    ];

    public function product_cate(){
        return $this->belongsTo('App\Models\Categories', 'id', 'categories_id');
    }
}
