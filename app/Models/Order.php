<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Order extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    const STATUS_PENDING = 'pending';
    const STATUS_COMPLETED = 'completed';

    public function billingDetail(): BelongsTo
    {
        return $this->belongsTo(BillingDetails::class);
    }

    public function orderProducts(): HasMany
    {
        return $this->hasMany(OrderedProduct::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'ordered_by', 'id');
    }
}
