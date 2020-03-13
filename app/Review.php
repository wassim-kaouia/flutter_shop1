<?php

namespace App;

use App\User;
use App\Product;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable = [
        'user_id',
        'product_id',
        'stars',
        'review',
    ];


    public function product(){
        return $this->belongsTo(Product::class);
    }
    
    public function customer(){
        return $this->belongsTo(User::class,'user_id','id');
    }


}
