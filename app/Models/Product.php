<?php

namespace App\Models;

use App\Models\Scopes\StoreScope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
class Product extends Model
{
    use HasFactory;
    protected $fillable=[
        'name','slug','description','image','price',
            'compare_price','status','store_id','category_id'
    ];
    protected static function booted(){
        static::addGlobalScope("store",new StoreScope());
    }

    public function category()
    {
        return $this->belongsTo(Category::class,"category_id","id");
    }

    public function store()
    {
        return $this->belongsTo(Store::class,"store_id","id");
    }

    public function tags()
    {
        return $this->belongsToMany(
            Tag::class,    //Related Model
            'product_tag', // pivot table name
            'product_id',  // FK in pivot table for the current model
            'tag_id',      // FK in pivot table for the related model
            'id',         // PK current model
            'id'          // PK related model
        );
    }

    public function scopeActive(Builder $builder){
        $builder->where('status','=','active');
    }

    // Accessors
    public function getImageUrlAttribute(){
        if(!$this->image){
            // return default image if there is no photo
            return "https://powermaclive.eleospages.com/images/products_attr_img/matrix/default.png";
        }
        if(Str::startsWith($this->image,['http://','https://'])){
            return $this->image;
        }
        return asset('storage/' . $this->image);
    }

    public function getSalePercentAttribute(){
        if(!$this->compare_price){
            return 0;
        }
        return round(100 -(100 * $this->price / $this->compare_price),0);

    }
}
