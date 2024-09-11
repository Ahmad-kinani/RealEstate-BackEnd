<?php

namespace App\Enums\RealEstate;

use Illuminate\Support\Facades\App;

enum RealEstateStatus: string
{
    case TO_SALE = 'to sale';
    case TO_RENT = 'to rent';
    case SOLD = 'sold';
    case RENTED = 'rented';


    // public static function label($type): string
    // {
    //     return match ($type) {
    //         self::ACTIVE->value => 'admin',
    //         self::INACTIVE->value => 'user',
    //     };
    // }

    public static function getStatusNames(): array
    {
        return ['to sale', 'to rent', 'sold', 'rented'];
    }
}
