<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MovementRequestValidator extends FormRequest
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

        if ($this->isMethod('post')) {
            $rules = [
                'name' => 'required|string|max:255|unique:movement,name',
            ];
        }

        if ($this->isMethod('put') || $this->isMethod('patch')) {
            $movementId = $this->route('id');
            $rules = [
                'name' => 'sometimes|required|string|max:255|unique:movement,name,' . $movementId,
            ];
        }

        return $rules;
    }
}
