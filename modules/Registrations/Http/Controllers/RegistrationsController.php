<?php

namespace Modules\Registrations\Http\Controllers;

use Pingpong\Modules\Routing\Controller;
use Modules\Registrations\Repositories\Contracts\IRegistrationsRepository;
use Modules\Courses\Repositories\Contracts\ICoursesRepository;
use Modules\Students\Repositories\Contracts\IStudentsRepository;
use Modules\Registrations\Http\Requests\RegistrationsRequest;
use Request;

class RegistrationsController extends Controller
{

    private $registrationsRepository;

    private $coursesRepository;

    private $studentsRepository;

    public function __construct(IRegistrationsRepository $registrationsRepository, ICoursesRepository $coursesRepository,
                                IStudentsRepository $studentsRepository)
    {
        $this->registrationsRepository = $registrationsRepository;
        $this->coursesRepository       = $coursesRepository;
        $this->studentsRepository      = $studentsRepository;
    }


    public function index()
    {
        $student = Request::get('student');
        $course  = Request::get('course');
        $status  = Request::get('status');
        $year    = Request::get('year');
        $isPaid  = Request::get('is_paid');

        $config = [
            'total'   => 10,
            'student' => $student,
            'course'  => $course,
            'status'  => $status,
            'year'    => $year,
            'isPaid'  => $isPaid
        ];

        $registrations = $this->registrationsRepository->fetch($config);

        return view('registrations::index',
            compact('registrations', 'student', 'course', 'status', 'year', 'isPaid')
        );
    }

    public function create()
    {
        $students = $this->studentsRepository->fetch()->pluck('name', 'id')->toArray();

        $courses = $this->coursesRepository->fetch()->pluck('name', 'id')->toArray();

        return view('registrations::create', compact('students', 'courses'));
    }

    public function store(RegistrationsRequest $data)
    {
        $newRegistration = $this->registrationsRepository->store($data->all());
        if(! $newRegistration) {
            return back()->withErrors(['Erro ao cadastrar novo curso. Por favor, tente novamente mais tarde.'])->withInput();
        }
        return redirect()->route('registrations.index')->with(['success' => 'Curso cadastrado com sucesso']);
    }

    public function edit($id)
    {
        $registration = $this->registrationsRepository->fetchById($id);

        return view('registrations::edit', compact('registration'));
    }

    public function update(RegistrationsRequest $data, $id)
    {
        $updatedRegistration = $this->registrationsRepository->update($data->all(), $id);
        if(! $updatedRegistration) {
            return back()->withErrors(['Erro ao atualizar curso. Por favor, tente novamente mais tarde.'])->withInput();
        }
        return redirect()->route('registrations.edit', $id)->with(['success' => 'Curso atualizado com sucesso']);
    }

    public function delete($id)
    {
        $deleted = $this->registrationsRepository->delete($id);
        if(! $deleted) {
            return back()->withErrors(['Erro ao excluir curso']);
        }
        return redirect()->route('registrations.index')->with(['success' => 'Curso excluído com sucesso']);

    }
}