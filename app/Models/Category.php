<?php

namespace App\Models;

use App\Rules\Filter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Validation\Rule;

class Category extends Model
{
    use HasFactory,SoftDeletes;

    protected $guarded = [];

    public function scopeFilter(Builder $builder,$filters)
    {
        if($filters['name']?? false){
            $builder->where('categories.name','LIKE',"%{$filters['name']}%");
        }
        if($filters['status']?? false){
            $builder->where('categories.status','=',$filters['status']);
        }
    }

    public static function rules($id=0): array
    {
        return [
            'name' => [
                'required',
                'string',
                'min:3',
                'max:255',
                Rule::unique('categories','name')->ignore($id),
                new Filter(['php','laravel']),
            ],
            'parent_id' => [
                'nullable', 'exists:categories,id', 'int',
            ],
            'image' => [
                'image', 'max:1048576', 'dimensions:min_width=100,min_height=100',
            ],
            'status' => 'in:active,archived'
        ];
    }
}
