<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Convert extends Model
{
    protected $table = 'conversions';
    protected $fillable = [
        'amount',
        'currency',
        'rate',
        'result',
    ];
}
