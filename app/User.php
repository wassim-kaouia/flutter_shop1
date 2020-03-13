<?php

namespace App;

use App\Role;
use App\Order;
use App\Review;
use App\Ticket;
use App\Address;
use App\Payment;
use App\Shipment;
use App\WishList;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'email_verified',
        'phone',
        'phone_verified',
        'shipping_address',
        'billing_address' 
    ];

    public function orders(){
        return $this->hasMany(Order::class);
    }

    public function payments(){
        return $this->hasMany(Payment::class);
    }

    public function shippments(){
        return $this->hasMany(Shipment::Class);
    }

    public function shipingAddress(){
        return $this->hasOne(Address::class,'id','shipping_address');
    }

    public function billingAddress(){
        return $this->hasOne(Address::class,'id','billing_address');
    }

    public function wishlist(){
        return $this->hasOne(WishList::class);
    }

    public function reviews(){
        return $this->hasMany(Review::class);
    }

    public function roles(){
        return $this->belongsToMany(Role::class);
    }

    public function formattedName(){
        return $this->first_name.' '.$this->last_name;
    }

    public function ticket(){
        return $this->hasMany(Ticket::class);
    }
    

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
