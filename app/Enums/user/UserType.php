<?php

namespace App\Enums\user;

use Illuminate\Support\Facades\App;

enum UserType: string
{
    case ADMIN = 'admin';
    case USER = 'user';
    case customer = 'customer';


    public static function label($type): string
    {
        return match ($type) {
            self::ADMIN->value => 'admin',
            self::USER->value => 'user',
        };
    }

    public static function getTypeNames(): array
    {
        return ['admin', 'user', "customer"];
    }
    public static function getTypeNamesOfCustomer()
    {
        return ["customer"];
    }
    public static function getTypeNamesOfUser()
    {
        return ["user" , "admin"];
    }
}