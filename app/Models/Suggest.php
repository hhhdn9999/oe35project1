<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Suggest extends Model
{
    protected $table = 'suggest';
    protected $primaryKey = 'id';
    protected $guarded = [];

    public function product_cate(){
        return $this->belongsTo('App\Models\Categories', 'id', 'categories_id');
    }

    public function user(){
        return $this->belongsTo('App\User', 'id', 'id');
    }
}
