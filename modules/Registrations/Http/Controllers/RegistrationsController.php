<?php

namespace Modules\Registrations\Http\Controllers;

use Pingpong\Modules\Routing\Controller;
use Modules\Registrations\Repositories\Contracts\IRegistrationsRepository;
use Modules\Courses\Repositories\Contracts\ICoursesRepository;
use Modules\Students\Repositories\Contracts\IStudentsRepository;
use Modules\Registrations\Http\Requests\RegistrationsRequest;
use Modules\Registrations\Http\Requests\CancelRegistrationsRequest;
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

    public function show($id)
    {
        $registration = $this->registrationsRepository->fetchById($id);

        $payments     = $registration->payments;

        return view('registrations::show', compact('registration', 'payments'));
    }

    public function create()
    {
        $students = $this->studentsRepository->fetch(['total' => 10]);

        $courses = $this->coursesRepository->fetch();

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

    public function delete($id)
    {
        $deleted = $this->registrationsRepository->delete($id);
        if(! $deleted) {
            return back()->withErrors(['Erro ao excluir curso']);
        }
        return redirect()->route('registrations.index')->with(['success' => 'Matrícula excluído com sucesso']);

    }

    public function cancelIndex($id)
    {
        $registration = $this->registrationsRepository->fetchById($id);
        $tax          = $this->registrationsRepository->getTaxForCancel($registration);

        return view('registrations::cancel.index', compact('registration', 'tax'));
    }

    public function cancelStore($id, CancelRegistrationsRequest $data)
    {
        $canceledRegistration = $this->registrationsRepository->cancel($id, $data->all());
        if(! $canceledRegistration) {
            return back()->withErrors(['Erro ao cancelar matrícula. Por favor, tente novamente mais tarde.']);
        }
        return redirect()->route('registrations.index')->with(['success' => 'A matrícula foi cancelada com sucesso!']);
    }
}