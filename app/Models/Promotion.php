<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    protected $table = 'promotions';
    protected $primaryKey = 'promo_id';
    public $timestamps = false;
    protected $fillable = [
        'promo_code',
        'promo_name',
        'promo_type',
        'discount_percent',
        'buy_qty',
        'get_qty',
        'min_order_value',
        'start_date',
        'end_date',
        'is_active',
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'promotion_products', 'promo_id', 'product_id');
    }

    public function orders()
    {
        return $this->hasMany(Order::class, 'promo_id', 'promo_id');
    }
}
