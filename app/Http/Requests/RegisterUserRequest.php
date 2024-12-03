<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterUserRequest extends FormRequest
{
    public function authorize()
    {
        return true; // Ensure authorization logic passes
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'phone_number' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'fitness_goal' => 'nullable|string|max:255',
            'preferences' => 'nullable|string|max:255',
            'password' => 'required|string|min:6|confirmed',
            'role_id' => 'required|in:1,2', // Ensure role_id is either 1 (admin) or 2 (user)
        ];
    }
}

