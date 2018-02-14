<?php

namespace Modules\Courses\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CoursesRequest extends FormRequest
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
            'name'            => 'required',
            'monthly_fee'     => 'required',
            'registration_fee'=> 'required',
            'period'          => 'required|in:morning,afternoon,night',
            'duration_months' => 'required|integer'
        ];
    }

    public function messages()
    {
        return [
            'name.required'             => 'O campo nome é obrigatório',
            'monthly_fee.required'      => 'O campo valor da mensalidade é obrigatório',
            'registration_fee.required' => 'O campo valor da matricula é obrigatório',
            'period.required'           => 'O campo período é obrigatório',
            'period.in'                 => 'O campo período deve conter um dos seguintes valores: matutino, vespertino, noturno',
            'duration_months.required'  => 'O campo meses de duração é obrigatório',
            'duration_months.integer'   => 'O campo meses de duração deve ser um número inteiro',

        ];
    }

}