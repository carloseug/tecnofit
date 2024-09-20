<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PersonalRecordRequestValidator extends FormRequest
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
                'user_id' => 'required|integer|exists:users,id',
                'movement_id' => 'required|integer|exists:movement,id',
                'value' => 'required|numeric',
                'date' => 'required|date',
            ];
        }

        if ($this->isMethod('put') || $this->isMethod('patch')) {
            $rules = [
                'user_id' => 'sometimes|required|integer|exists:users,id',
                'movement_id' => 'sometimes|required|integer|exists:movement,id',
                'value' => 'sometimes|required|numeric',
                'date' => 'sometimes|required|date',
            ];
        }

        return $rules;
    }
}
