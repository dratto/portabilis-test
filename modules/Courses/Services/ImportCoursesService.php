<?php

namespace Modules\Courses\Services;

use Modules\Courses\Repositories\Contracts\ICoursesRepository;
use Exception;

class ImportCoursesService
{

    private $coursesRepository;

    public function __construct(ICoursesRepository $coursesRepository)
    {
        return $this->coursesRepository = $coursesRepository;
    }

    public function import()
    {
        $coursesData = $this->getCoursesData();
        foreach($coursesData as $courseData) {
            try {
                $this->coursesRepository->store($courseData);
            } catch(Exception $e) {
                continue;
            }
        }
    }

    private function getFileContent()
    {
        $file = storage_path('app/import-files/courses.csv');
        return file_get_contents($file);

    }

    private function getCoursesData()
    {
        $fileContent = $this->getFileContent();
        $lines = explode("\n", $fileContent);
        unset($lines[0]);
        $data = [];
        foreach($lines as $line) {
            if(! empty($line)) {

                $columns = explode(',', $line);

                $data[] = [
                    'id'               => str_replace('"', '', $columns[0]),
                    'name'             => str_replace('"', '', $columns[1]),
                    'monthly_fee'      => str_replace('"', '', $columns[2]),
                    'registration_fee' => str_replace('"', '', $columns[3]),
                    'period'           => $this->getPeriodValue(str_replace('"', '', $columns[4])),
                    'duration_months'  => str_replace('"', '', $columns[5])
                ];
            }
        }
        return $data;
    }

    public function getPeriodValue($period)
    {
        switch($period) {
            case 'matutino':
                return 'morning';
                break;
            case 'vespertino':
                return 'afternoon';
                break;
            case 'noturno':
                return 'night';
                break;
        }
    }


}