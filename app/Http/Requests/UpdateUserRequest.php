<?php

namespace App\Http\Requests;

use App\Enums\user\UserType;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class UpdateUserRequest extends FormRequest
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

        $rules = User::rules($this->id);
        $rules = array_merge($rules, [
            'type' => 'required|string|in:' . implode(",", UserType::getTypeNames()),
            // 'password' => ["string", Password::defaults()], // ,"required"
        ]);
        return $rules;
    }
}
