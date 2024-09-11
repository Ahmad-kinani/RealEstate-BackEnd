<?php

namespace App\Enums\user;

use Illuminate\Support\Facades\App;

enum UserStatus: string
{
    case ACTIVE = 'active';
    case INACTIVE = 'inactive';


    // public static function label($type): string
    // {
    //     return match ($type) {
    //         self::ACTIVE->value => 'admin',
    //         self::INACTIVE->value => 'user',
    //     };
    // }

    public static function getStatusNames(): array
    {
        return ['active', 'inactive'];
    }
}