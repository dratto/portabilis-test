<?php

namespace Modules\Registrations\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegistrationsRequest extends FormRequest
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
            'student_id' => 'required|student_schedule:'.$this->course_id,
            'course_id'  => 'required',
        ];
    }

    public function messages()
    {
        $coursesRepository = app('Modules\Courses\Repositories\Contracts\ICoursesRepository');
        $course = $coursesRepository->fetchById($this->course_id);
        return [
            'student_id.required'         => 'Por favor selecione um aluno',
            'student_id.student_schedule' => 'O aluno selecionado já está matriculado em um curso no período '. $course->present()->period,
            'course_id.required'          => 'Por favor selecione um curso',
        ];
    }

}