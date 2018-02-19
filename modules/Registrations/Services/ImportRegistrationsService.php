<?php

namespace Modules\Registrations\Services;

use Modules\Registrations\Repositories\Contracts\IRegistrationsRepository;
use Exception;


class ImportRegistrationsService
{

    private $registrationsRepository;

    public function __construct(IRegistrationsRepository $registrationsRepository)
    {
        $this->registrationsRepository = $registrationsRepository;

    }

    public function import()
    {
        $registrationsData = $this->getRegistrationsData();
        foreach($registrationsData as $registrationData) {
            try {
                $isValid = $this->validateStudentSchedule($registrationData['student_id'], $registrationData['course_id'], $registrationData['year']);
                if($isValid) {
                    $this->registrationsRepository->store($registrationData);
                }
            } catch(Exception $e) {
                throw $e;
            }
        }
    }

    private function getFileContent()
    {
        $file = storage_path('app/import-files/registrations.csv');
        return file_get_contents($file);

    }

    private function getRegistrationsData()
    {
        $fileContent = $this->getFileContent();
        $lines = explode("\n", $fileContent);
        unset($lines[0]);
        $data = [];
        foreach($lines as $line) {
            if(! empty($line)) {

                $columns = explode(';', $line);

                $data[] = [
                    'student_id' => $columns[1],
                    'course_id'  => $columns[2],
                    'year'       => $columns[3]
                ];
            }
        }

        return $data;
    }

    private function validateStudentSchedule($studentId, $courseId, $year)
    {
        $studentsRepository = app('Modules\Students\Repositories\StudentsRepository');
        $coursesRepository  = app('Modules\Courses\Repositories\CoursesRepository');
        $student = $studentsRepository->fetchById($studentId);
        $course  = $coursesRepository->fetchById($courseId);
        if($student && $course) {
            $busyPeriods = $student->registrations;
            foreach($busyPeriods as $busyPeriod) {
                if( ($busyPeriod->course->period === $course->period) &&
                    ($busyPeriod->year == $year)) {
                    return false;
                }
            }
            return true;
        }
        return false;
    }


}