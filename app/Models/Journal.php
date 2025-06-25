<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Journal extends Model
{
    public function sale()
    {
        return $this->belongsTo(Sale::class);
    }
}
