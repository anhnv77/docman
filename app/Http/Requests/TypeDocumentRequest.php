<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class TypeDocumentRequest extends Request
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
            'name' => 'required|unique:type_documents,name',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => trans('typedocument.validate.name_required'),
            'name.unique' => trans('typedocument.validate.name_unique'),
        ];
    }
}
