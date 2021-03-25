<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StudentFormRequest extends FormRequest
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
        $id = $this->segment(3)??0;

        return [
            'name'  => ['required', 'min:3', 'max:150'],
            'email' => ['required', 'email'],
            'cpf'   => ['required', 'min:11', 'max:14'],
            'ra'    => ['required', 'min:6', 'max:20', "unique:students,ra,{$id},id"],
        ];
    }
}
