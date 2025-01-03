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
            'email' => 'required|email|max:255|unique:users,email',
            'fitness_goal' => 'nullable|string|max:255',
            'preferences' => 'nullable|string|max:255',
            'password' => 'required|string|min:6|confirmed',
            'role_id' => 'required|in:1,2',  // Ensure you handle the proper roles
        ];
    }
}
