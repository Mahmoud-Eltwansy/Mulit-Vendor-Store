<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'store_id',
        'status',
        'payment_status',
        'payment_method',
    ];

    protected static function booted(){
        static::creating(function(Order $order){
            $order->number=Order::getNextOrderNumber();
        });
    }
    public function store (){
        return $this->belongsTo(Store::class,'store_id','id');
    }

    public function user (){
        return $this->belongsTo(User::class,'user_id','id')->withDefault([
            'name' => 'Guest Customer'
        ]);
    }

    public function products (){
        return $this->belongsToMany(Product::class,'order_items','order_id','product_id','id','id')
            ->using(OrderItem::class)
            ->withPivot([
                'product_name','price','quantity','options'
            ]);
    }

    public function addresses(){
        return $this->hasMany(OrderAddress::class);
    }

    public function billingAddress(){
        return $this->hasOne(OrderAddress::class,'order_id','id')->where('type','billing');
    }

    public function shippingAddress(){
        return $this->hasOne(OrderAddress::class,'order_id','id')->where('type','shipping');
    }

    public static function getNextOrderNumber(){
        $year = Carbon::now()->year;
        $number = Order::whereYear('created_at', $year)->max('number');
        if ($number){
            return $number + 1 ;
        }
        return $year. '0001';
    }

}
