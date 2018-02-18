<?php

namespace App\Services;


use Exception;
use Modules\Students\Services\ImportStudentsService;
use Modules\Courses\Services\ImportCoursesService;
use Modules\Registrations\Services\ImportRegistrationsService;

class ImportCSVData
{

    private $importStudentsService;

    private $importCoursesService;

    private $importRegistrationsService;

    public function __construct(ImportStudentsService $importStudentsService,
                                ImportCoursesService $importCoursesService,
                                ImportRegistrationsService $importRegistrationsService)
    {
        $this->importStudentsService       = $importStudentsService;
        $this->importCoursesService        = $importCoursesService;
        $this->importRegistrationsService  = $importRegistrationsService;
    }

    public function import()
    {
        try {
            $this->importStudentsService->import();
            $this->importCoursesService->import();
            $this->importRegistrationsService->import();
        } catch(Exception $e) {
            throw $e;
        }


    }


}