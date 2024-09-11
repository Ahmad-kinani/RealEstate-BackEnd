<?php

namespace App\Models;

use App\Enums\RealEstate\RealEstateStatus as RealEstateStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class RealEstate extends Model
{
    use HasFactory;
    protected $fillable = [
        'address',
        'type',
        'price',
        'details',
        'garage',
        'section',
        'property',
        'balcony',
        'furniture',
        'status',
        'lock_date',
        'months',
        'user_id',
        'currency_id'
    ];
    public function user(): belongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function currency(): BelongsTo
    {
        return $this->belongsTo(Currency::class);
    }

    public function photos(): HasMany
    {
        return $this->HasMany(Photo::class);
    }

    public function favorite(): HasMany
    {
        $user = auth()->user();
        if (!$user) {
            return $this->hasMany(Favorite::class, 'real_estate_id', 'id')->where('user_id', 0);
        } else {
            return $this->hasMany(Favorite::class, 'real_estate_id', 'id')->where('user_id', $user->id);
        }
        // return $this->HasMany(Favorite::class);
    }

    protected  static function rules($real_estate_id = null): array
    {
        $arr = [
            'address' => "required|string",
            'type' => "required|string",
            'price' => "required|numeric",
            'details' => 'required|string',
            'garage' => 'required|string',
            'section' => 'required|string',
            'property' => 'required|string',
            'balcony' => 'required|string',
            'furniture' => 'required|string',
            'status' => 'required|string|in:' . implode(",", RealEstateStatus::getStatusNames()),
            'lock_date' => 'required|date',
            'months' => 'nullable|integer',
            'currency_id' => 'required|integer|exists:currencies,id',


            'images' => 'nullable|array',
            'images.*' => 'required|mimes:jpeg,png,jpg,svg',

            'deletePhotos' => 'nullable|array',
            'deletePhotos.*' => 'required|integer'

        ];

        if (!$real_estate_id) {
            $arr[] = ['photos' => 'nullable|array'];
            $arr[] = ['photos.*' => 'required|mimes:jpeg,png,jpg,svg,image/jpeg'];
        }
        return $arr;
    }
}
