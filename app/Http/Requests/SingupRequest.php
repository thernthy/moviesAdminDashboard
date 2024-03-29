<?php

namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;

class SingupRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
        {
            return [
                'name' => 'required|string|max:55',
                'email' => 'required|email|unique:cms_users,email',
                'password' => [
                    'required',
                    'confirmed',
                    'min:8', // Minimum length of 8 characters
                    'regex:/^(?=.*[a-zA-Z])(?=.*[!@#$%^&*()\-_=+{};:,<.>ยง~])(?=.*[0-9]).*$/',
                ],
            ];
        }
}
