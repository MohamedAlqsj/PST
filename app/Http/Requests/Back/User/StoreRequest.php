<?php

namespace App\Http\Requests\Back\User;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
        $rules = [
            'first_name' => ['required', 'string', 'max:255'],
            'second_name' => ['required', 'string', 'max:255'],
            'third_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'age' => ['required', 'numeric'],
            'dob' => ['required'],
            'gender' => ['required'],
            'type' => ['required'],
            'mobile_number' => ['required'],
            'roles' => 'required',
            'roles.*' => 'required',
        ];

        if ($this->getMethod() == 'POST') {
            $rules += [
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'string', 'min:8', 'confirmed'],
            ];
        }

        if ($this->getMethod() == 'PATCH') {
            $user = '';
            if ($this->profile) {
                $user = $this->profile;
            } else {
                $user = $this->user;
            }

            $rules += [
                   'email' => [
                       'required',
                       Rule::unique('users')->ignore($user),
                   ],
               ];
        }

        return $rules;
    }
}
