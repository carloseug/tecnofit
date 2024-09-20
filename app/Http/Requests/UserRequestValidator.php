<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequestValidator extends FormRequest
{
    /**
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * @return array
     */
    public function rules()
    {
        $rules = [];
        
        if ($this->isMethod('put') || $this->isMethod('patch')) {
            $userId = $this->route('id');
            $rules = [
                'name' => 'sometimes|required|string|max:255',
                'email' => 'sometimes|required|email|max:255|unique:users,email,' . $userId,
                'password' => 'nullable|string|min:6|confirmed',
            ];
        }

        return $rules;
    }
}
