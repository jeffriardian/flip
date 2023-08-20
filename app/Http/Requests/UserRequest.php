<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        $rules = [];

        if($this->isMethod('put')) {
            $rules += ['username' => 'required|unique:users,username'];
        }
        
        if($this->isMethod('post')) {
            $rules += ['username' => 'required|unique:users,username'];
        }

        return $rules;
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json($validator->errors(), 409));
    }

    public function messages()
    {
        return [
            'username.unique' => 'Username already exists'
        ];
    }
}
