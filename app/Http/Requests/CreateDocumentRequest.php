<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class CreateDocumentRequest extends Request
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
            'title' => 'required:documents,title',
            'content' => 'required:documents,content',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Nhập Tên Tài Liệu',
            'content.required' => ' Chưa Upload File',
        ];
    }
}
