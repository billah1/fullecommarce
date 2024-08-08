<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CouponUsage extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function Coupon()
    {
        return $this->hasMany(Coupon::class);
    }
}
