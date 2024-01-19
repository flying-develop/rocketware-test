<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'name' => 'required',
            'email' => [
                'required',
                'unique:users,email',
                'email:dns',
            ],
            'phone' => [
                'required',
                'unique:users,phone',
                'string',
                'size:12',
                'starts_with:+7',
                function ($attribute, $value, $fail) {
                    $wrongSymbols = preg_replace('/[^+\d]/', '*', $value);
                    if (substr_count($wrongSymbols, '*')) {
                        $fail('Phone contains wrong symbols');
                    }
                }
            ],
            'password' => [
                'required',
                'min:6',
                'confirmed',
                'regex:/^[a-zA-Z0-9$%&!:.]+$/',
                function ($attribute, $value, $fail) {
                    $contains = preg_match('/[a-z]/', $value);
                    if (!$contains) {
                        $fail('No small latina-symbols in password');
                    }
                },
                function ($attribute, $value, $fail) {
                    $contains = preg_match('/[A-Z]/', $value);
                    if (!$contains) {
                        $fail('No capital latina-symbols in password');
                    }
                },
                function ($attribute, $value, $fail) {
                    $contains = preg_match('/[$%&!:.]/', $value);
                    if (!$contains) {
                        $fail('No special symbols in password');
                    }
                }
            ]
        ];
    }
}
