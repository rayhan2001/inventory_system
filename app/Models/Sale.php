<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    protected $fillable = [
        'discount',
        'received_amount',
        'due_amount',
        'total_amount',
        'sale_date',
    ];

    public function items()
    {
        return $this->hasMany(SaleItem::class);
    }

    public function journals()
    {
        return $this->hasMany(Journal::class);
    }
}
