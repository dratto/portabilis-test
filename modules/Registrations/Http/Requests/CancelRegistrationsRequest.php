<?php

namespace Modules\Registrations\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CancelRegistrationsRequest extends FormRequest
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
            'tax' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'tax' => 'O valor da multa não foi recebido, por favor, tente novamente mais tarde'
        ];
    }

}