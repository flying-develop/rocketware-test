<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

        return [
            'login' => [
                'required',
                function ($attribute, $value, $fail) {
                    $exists = User::query()
                        ->where('email', $value)
                        ->orWhere('phone', $value)
                        ->exists();

                    if (!$exists) {
                        $fail('User not found.');
                    }
                }
            ],
            'password' => 'required'
        ];
    }

    protected function passedValidation() : void
    {
        $this->merge([
            'email' => User::query()
                ->where('email', request('login'))
                ->orWhere('phone', request('login'))
                ->value('email')
        ]);
    }

}