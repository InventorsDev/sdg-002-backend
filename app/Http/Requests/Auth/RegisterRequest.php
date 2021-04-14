<?php

namespace App\Http\Requests\Auth;

use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'string|required|max:255',
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique(User::class)],
            'password' => 'string|required|min:6',
        ];
    }
}
