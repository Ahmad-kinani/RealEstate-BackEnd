<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Favorite extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'real_estate_id'
    ];

    public function RealEstate(): BelongsTo
    {
        return $this->belongsTo(RealEstate::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    protected  static function rules($id = null): array
    {
        $arr = [
            'real_estate_id' => 'required|integer|exists:real_estates,id',
        ];
        return $arr;
    }
}