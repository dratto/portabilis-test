<?php

namespace App\Validators;

use Illuminate\Validation\Validator;

class ExtraValidator extends Validator
{
    const CPF_EXAMPLE   = '999.999.999-99';

    /**
     * Valida número de CPF
     * @param $attribute
     * @param $value
     * @param array $parameters
     * @return bool
     */
    public function validateCPF($attribute, $value, $parameters = [])
    {
        $isValid = $this->validateRegex($attribute, $value, [regex_cpf()]);

        if (!$isValid) {
            return false;
        }

        return isValidCPF($value);
    }

    /**
     * Válida se aluno pode ser matrículado em determinado curso
     * @param $attribute
     * @param $value
     * @param array $parameters
     * @return bool
     */
    public function validateStudentSchedule($attribute, $value, $parameters = [])
    {
        $studentsRepository = app('Modules\Students\Repositories\StudentsRepository');
        $coursesRepository  = app('Modules\Courses\Repositories\CoursesRepository');
        $student = $studentsRepository->fetchById($value);
        $course  = $coursesRepository->fetchById($parameters[0]);
        if($student && $course) {
            $busyPeriods = $student->registrations;
            foreach($busyPeriods as $busyPeriod) {
                if( ($busyPeriod->course->period === $course->period) &&
                    (date('Y', strtotime($busyPeriod->course->created_at)) === date('Y'))) {
                    return false;
                }
            }
            return true;
        }
        return false;
    }
}