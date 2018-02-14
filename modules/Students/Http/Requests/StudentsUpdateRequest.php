<?php

namespace Modules\Students\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StudentsUpdateRequest extends FormRequest
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
            'cpf'           => 'required|cpf|unique:students,cpf,'. $this->id. ',id',
            'name'          => 'required',
            'date_of_birth' => 'date_format:d/m/Y',
        ];
    }

    public function messages()
    {
        return [
            'cpf.required'              => 'O campo CPF é obrigatório',
            'cpf.unique'                => 'O CPF informado já está cadastrado',
            'cpf.cpf'                   => 'O CPF informado está inválido',
            'name.required'             => 'O campo nome é obrigatório',
            'date_of_birth.date_format' => 'A data de nascimento deve estar no formato: dia/mês/ano'
        ];
    }

}