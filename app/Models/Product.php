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

    public function getDiscountAttribute()
    {
        return round((($this->product_old_price - $this->product_price) / $this->product_old_price) * 100, 2) . "% off";
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

    public function orderSummaries()
    {
        return $this->hasMany(OrderSummary::class);
    }

    public function productSizes()
    {
        return $this->hasMany(ProductSize::class);
    }

    public function productColors()
    {
        return $this->hasMany(ProductColor::class);
    }

    public function productRatings()
    {
        return $this->hasMany(ProductRating::class);
    }

    public function averageRatings()
    {
        return number_format($this->productRatings()->avg('rating'), 1);
    }

    public function productImages()
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    public function productStocks()
    {
        return $this->productSizes()->sum('stock') ?: $this->productColors()->sum('stock') ?: $this->product_stock;
    }

    public function shortOrderSold()
    {

        $value =  $this->orders()
            ->where('order_status', '!=', 'Cancelled')
            ->sum('order_quantity');

        if ($value >= 1000000000) {
            return number_format($value / 1000000000, 1) . 'B';
        } elseif ($value >= 1000000) {
            return number_format($value / 1000000, 1) . 'M';
        } elseif ($value >= 1000) {
            return number_format($value / 1000, 1) . 'k';
        } else {
            return $value;
        }
    }

    public function shortProductStocks()
    {

        $value =  $this->productStocks();

        if ($value >= 1000000000) {
            return number_format($value / 1000000000, 1) . 'B';
        } elseif ($value >= 1000000) {
            return number_format($value / 1000000, 1) . 'M';
        } elseif ($value >= 1000) {
            return number_format($value / 1000, 1) . 'k';
        } else {
            return $value;
        }
    }
}
