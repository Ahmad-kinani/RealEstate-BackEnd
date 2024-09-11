<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class InvoiceResource extends JsonResource
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
            "type" => $this->type,
            "price" => $this->price,
            "date" => $this->date,
            "details" => $this->details,
            "currency" => $this->currency,
            "real_estate" => $this->RealEstate,
            "method_payment" => $this->methodPayment,
            "customer" => new UserResource($this->user)
        ];
    }
}