<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'purchase_price',
        'sell_price',
        'stock',
    ];
    
    /**
     * Get the sale items associated with the product.
     */
    public function saleItems()
    {
        return $this->hasMany(SaleItem::class);
    }
}
