<?php

namespace Modules\Students\Services;

use Modules\Students\Repositories\Contracts\IStudentsRepository;
use Exception;

class ImportStudentsService
{

    private $studentsRepository;

    public function __construct(IStudentsRepository $studentsRepository)
    {
        return $this->studentsRepository = $studentsRepository;
    }

    public function import()
    {
        $studentsData = $this->getStudentsData();
        foreach($studentsData as $studentData) {
            try {
                $this->studentsRepository->store($studentData);
            } catch(Exception $e) {
                continue;
            }
        }
    }

    private function getFileContent()
    {
        $file = storage_path('app/import-files/students.csv');
        return file_get_contents($file);

    }

    private function getStudentsData()
    {
        $fileContent = $this->getFileContent();
        $lines = explode("\n", $fileContent);
        unset($lines[0]);
        $data = [];
        foreach($lines as $line) {
            if(! empty($line)) {
                $columns = explode(';', $line);

                $data[] = [
                    'id'            => $columns[0],
                    'name'          => $columns[1],
                    'cpf'           => $columns[2],
                    'rg'            => $columns[3],
                    'phone'         => $columns[4],
                    'date_of_birth' => $columns[5]
                ];
            }
        }
        return $data;
    }


}