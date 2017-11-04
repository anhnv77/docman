<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class CreateUserRequest extends Request
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
        return [
            'name' => 'required:users,name',
            'email' => 'required|unique:users,email',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => trans('users.validate.name_required'),
            'email.required' => trans('users.validate.email_required'),
            'email.unique' => trans('users.validate.email_uniquired'),
        ];
    }
}
