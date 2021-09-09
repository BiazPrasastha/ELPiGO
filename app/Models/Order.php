<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    function Inventory()
    {
        return $this->belongsTo(Inventory::class, 'inventory_id');
    }
    function Promo()
    {
        return $this->belongsTo(Promo::class, 'promo_id');
    }
}
