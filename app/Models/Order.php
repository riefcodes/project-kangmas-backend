<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Order extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'user_id',
        'tukang_id',
        'description',
        'image_path',
        'status',
        'total_price',
    ];

    /**
     * Get the customer who placed this order.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the tukang assigned to this order.
     */
    public function tukang(): BelongsTo
    {
        return $this->belongsTo(User::class, 'tukang_id');
    }

    /**
     * Get the review for this order.
     */
    public function review(): HasOne
    {
        return $this->hasOne(Review::class);
    }
}
