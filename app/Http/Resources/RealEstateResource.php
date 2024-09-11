<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RealEstateResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id" => $this->id,
            "address" => $this->address,
            "type" => $this->type,
            "price" => $this->price,
            "details" => $this->details,
            "garage" => $this->garage,
            "section" => $this->section,
            "property" => $this->property,
            "balcony" => $this->balcony,
            "furniture" => $this->furniture,
            "status" => $this->status,
            "lock_date" => $this->lock_date,
            "currency" => $this->currency,
            "favorite" => $this->favorite,
            "user" => new UserResource($this->user),
            "photos" => $this->photos->map(function ($photo) {
                return $photo ?  ['photo' => route('realEstatePhoto', ['file_path' => $photo->name]), 'id' => $photo->id] : null;
            }),
            // "photo" => $this->photo ? route('userPhoto', ['file_path' => $this->photo]) : null,
        ];
    }
}