<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function product_category()
    {
        return $this->belongsTo(ProductCategory::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'carts')->withPivot('quantity');
    }

    public function products()
    {
        return $this->belongsToMany(Product::class)->withPivot('quantity');
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }



    public function scopeSearch($query, $terms)
    {
        collect(explode(" ", $terms))
            ->filter()
            ->each(function ($term) use ($query) {
                $term = '%' . $term . '%';
                $query->where('product_name', 'like', $term)
                    ->orWhere('product_status', 'like', $term)
                    ->orWhere('product_code', 'like', $term);
            });
    }
}
