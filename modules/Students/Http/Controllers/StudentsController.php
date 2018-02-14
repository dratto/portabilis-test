<?php

namespace Modules\Students\Http\Controllers;

use Pingpong\Modules\Routing\Controller;
use Modules\Students\Repositories\Contracts\IStudentsRepository;
use Modules\Students\Http\Requests\StudentsRequest;
use Modules\Students\Http\Requests\StudentsUpdateRequest;

class StudentsController extends Controller
{

    private $studentsRepository;

    public function __construct(IStudentsRepository $studentsRepository)
    {
        $this->studentsRepository = $studentsRepository;
    }


    public function index()
	{
	    $config = [
	        'total' => 10
        ];

	    $students = $this->studentsRepository->fetch($config);

		return view('students::index', compact('students'));
	}

	public function create()
    {
        return view('students::create');
    }

    public function store(StudentsRequest $data)
    {
        $newStudent = $this->studentsRepository->store($data->all());
        if(! $newStudent) {
            return back()->withErrors(['Erro ao cadastrar novo aluno. Por favor, tente novamente mais tarde.'])->withInput();
        }
        return redirect()->route('students.index')->with(['success' => 'Aluno cadastrado com sucesso']);
    }

    public function edit($id)
    {
        $student = $this->studentsRepository->fetchById($id);

        return view('students::edit', compact('student'));
    }

    public function update(StudentsUpdateRequest $data, $id)
    {
        $updatedStudent = $this->studentsRepository->update($data->all(), $id);
        if(! $updatedStudent) {
            return back()->withErrors(['Erro ao atualizar aluno. Por favor, tente novamente mais tarde.'])->withInput();
        }
        return redirect()->route('students.edit', $id)->with(['success' => 'Aluno atualizado com sucesso']);
    }

	public function delete($id)
    {
        $deleted = $this->studentsRepository->delete($id);
        if(! $deleted) {
            return back()->withErrors(['Erro ao excluir aluno']);
        }
        return redirect()->route('students.index')->with(['success' => 'Aluno excluído com sucesso']);

    }
}