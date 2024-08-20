<?php

namespace App\Models;

use App\Observers\CartObserver;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cookie;

class Cart extends Model
{
    use HasFactory;
    protected $increamnting = false;
    protected $fillable = [
        'cookie_id','product_id','user_id','quantity','options'
    ];

    // Events and Observers
    protected static function booted()
    {
        static::addGlobalScope('cookie_id',function(Builder $builder){
            $builder->where('cookie_id','=',Cart::getCookieId());
        });
        static::observe(CartObserver::class);
        // static::creating(function(Cart $cart){
        //     $cart->id=Str::uuid();
        // });
    }
    public static function getCookieId()
    {
        $cookie_id = Cookie::get('cart_id');

        // If there no cookie_id for this cart , So create one and add it to the queue under 'cart_id' name
        if(!$cookie_id)
        {
            $cookie_id=Str::uuid();
            Cookie::queue('cart_id',$cookie_id, 30*24*60 );
        }
        return $cookie_id;
    }

    // Relations
    public function user() {
        return $this->belongsTo(User::class)->withDefault([
            'name'=>'Anonymous'
        ]);
    }
    public function product(){
        return $this->belongsTo(Product::class);
    }


}
