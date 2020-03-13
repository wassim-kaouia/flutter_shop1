<?php

namespace App;

use App\Cart;
use App\User;
use App\Payment;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable =[
        'user_id',
        'cart_id',
        'payment_id',
        'order_date'
    ];
    //customer === user equal for me as dev/enginner
    public function customer(){
        return $this->belongsTo(User::class);
    }

    public function cart(){
        return $this->hasOne(Cart::class); 
    }

    public function payment(){
        return $this->hasOne(Payment::class);
    }
}
