<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Product extends Model
{
    use HasFactory;

    protected $guarded = ['id'];


    public function productImage(): HasMany
    {
        return $this->hasMany(ProductImage::class);
    }

    public function productSize(): HasMany
    {
        return $this->hasMany(ProductSize::class);
    }

    public function productColor(): HasMany
    {
        return $this->hasMany(ProductColor::class);
    }

    public function productCoupon(): HasMany
    {
        return $this->hasMany(ProductCoupon::class);
    }


    public function productCategory(): HasMany
    {
        return $this->hasMany(ProductCategory::class, 'product_id', 'id');
    }
    public function productCurrency(): BelongsTo
    {
        return $this->belongsTo(Currency::class, 'currency_id', 'id');
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function symbol(): BelongsTo
    {
        return $this->belongsTo(Currency::class, 'currency_id', 'id');
    }

}
