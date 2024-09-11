<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Enums\user\UserStatus;
use App\Enums\user\UserType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;

// use Tymon\JWTAuth\Contracts\JWTSubject;
// use PHPOpenSourceSaver\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    static $searchable = ["username", "full_name"];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        // return ["user_id" => $this->id];
        return [];
    }
    protected $fillable = [
        'username',
        'full_name',
        'email',
        'type',
        'status',
        'id_number',
        'photo',
        'phone',
        'gender',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];


    protected  static function rules($user_id = null): array
    {
        $arr = [
            'username' => "required|unique:users,username," . $user_id,
            'full_name' => "required|unique:users,full_name," . $user_id,
            'phone' => "string",
            'email' => "required|unique:users,email," . $user_id,
            'status' => 'required|string|in:' . implode(",", UserStatus::getStatusNames()),
            // 'photo' => 'mimes:jpeg,png,jpg,svg,image/jpeg',
            'id_number' => 'required|string|unique:users,full_name,' . $user_id,

        ];
        return $arr;
    }
    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }
}
