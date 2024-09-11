<?php

namespace App\Http\Requests;

use App\Enums\user\UserStatus;
use App\Enums\user\UserType;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\Rules\Password as RulesPassword;

class RegisterRequest extends FormRequest
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
            'password' => ["string", "required", RulesPassword::defaults()],
            'type' => 'required|string|in:' . implode(",", UserType::getTypeNamesOfCustomer()),
            'id_number' => 'required|string',
        ]);
        return $rules;
    }
}