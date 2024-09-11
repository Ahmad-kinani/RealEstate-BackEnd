<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CurrencyFactor extends Model
{
    use HasFactory;

    protected $fillable = [
        'currency_id',
        'for_currency_id',
        'factor',
    ];
}