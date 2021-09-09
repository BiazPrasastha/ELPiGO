<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\District;

class Citizen extends Model
{
    use HasFactory;
    function District()
    {
        return $this->belongsTo(District::class, 'district_id');
    }
}
