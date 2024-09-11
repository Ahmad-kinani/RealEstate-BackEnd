<?php

namespace App\Http\Requests;

use App\Models\RealEstate;
use Illuminate\Foundation\Http\FormRequest;

class addRealEstateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules = RealEstate::rules($this->id);
        return $rules;
    }
}