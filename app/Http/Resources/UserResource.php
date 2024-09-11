<?php

namespace App\Http\Resources;

use App\Enums\UserLanguage;
use App\Enums\UserStatus;
use App\Enums\UserType;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Storage;

class UserResource extends JsonResource
{

    public function __construct($resource, private $token = null)
    {
        parent::__construct($resource);
    }
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id" => $this->id,
            "username" => $this->username,
            "full_name" => $this->full_name,
            "email" => $this->email,
            "phone" => $this->phone,
            "status" => $this->status,
            "type" => $this->type,
            "gender" => $this->gender,
            "id_number" => $this->id_number,
            "photo" => $this->photo ? route('userPhoto', ['file_path' => $this->photo]) : null,
            'access_token' => $this->when($this->token, $this->token),
        ];
    }
}
