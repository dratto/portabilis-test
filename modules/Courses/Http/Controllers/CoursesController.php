<?php

namespace Modules\Courses\Http\Controllers;

use Pingpong\Modules\Routing\Controller;
use Modules\Courses\Repositories\Contracts\ICoursesRepository;
use Modules\Courses\Http\Requests\CoursesRequest;

class CoursesController extends Controller
{

    private $coursesRepository;

    public function __construct(ICoursesRepository $coursesRepository)
    {
        $this->coursesRepository = $coursesRepository;
    }


    public function index()
    {
        $config = [
            'total' => 10
        ];

        $courses = $this->coursesRepository->fetch($config);

        return view('courses::index', compact('courses'));
    }

    public function create()
    {
        return view('courses::create');
    }

    public function store(CoursesRequest $data)
    {
        $newCourse = $this->coursesRepository->store($data->all());
        if(! $newCourse) {
            return back()->withErrors(['Erro ao cadastrar novo curso. Por favor, tente novamente mais tarde.'])->withInput();
        }
        return redirect()->route('courses.index')->with(['success' => 'Curso cadastrado com sucesso']);
    }

    public function edit($id)
    {
        $course = $this->coursesRepository->fetchById($id);

        return view('courses::edit', compact('course'));
    }

    public function update(CoursesRequest $data, $id)
    {
        $updatedCourse = $this->coursesRepository->update($data->all(), $id);
        if(! $updatedCourse) {
            return back()->withErrors(['Erro ao atualizar curso. Por favor, tente novamente mais tarde.'])->withInput();
        }
        return redirect()->route('courses.edit', $id)->with(['success' => 'Curso atualizado com sucesso']);
    }

    public function delete($id)
    {
        $deleted = $this->coursesRepository->delete($id);
        if(! $deleted) {
            return back()->withErrors(['Erro ao excluir curso']);
        }
        return redirect()->route('courses.index')->with(['success' => 'Curso excluído com sucesso']);

    }
}