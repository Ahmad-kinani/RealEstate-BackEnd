<?php

namespace App\Http\Requests;

use App\Enums\user\UserType;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class StoreUserRequest extends FormRequest
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
        $rules = User::rules();
        $rules = array_merge($rules, [
            'password' => ["string", "required", Password::defaults()],
            'type' => 'required|string|in:' . implode(",", UserType::getTypeNamesOfUser()),
        ]);
        return $rules;
    }
}