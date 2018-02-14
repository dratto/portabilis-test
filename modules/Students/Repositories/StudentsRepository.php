<?php

namespace Modules\Students\Repositories;

use Modules\Students\Repositories\Contracts\IStudentsRepository;
use Modules\Students\Entities\Students;

class StudentsRepository implements IStudentsRepository
{
    private $model;

    public function __construct(Students $model)
    {
        $this->model = $model;
    }

    public function fetch($config)
    {
        $students = $this->model->orderBy('created_at', 'desc');

        if (isset($config['total']) and !empty($config['total'])) {
            return $students->paginate($config['total']);
        }

        return $students->get();
    }

    public function fetchById($id)
    {
        return $this->model->find($id);
    }

    public function store($data)
    {
        return $this->model->fill($data)->save();
    }

    public function update($data, $id)
    {
        $student = $this->model->find($id);
        return $student->fill($data)->save();

    }

    public function delete($id)
    {
        $student = $this->model->find($id);
        return $student->delete();
    }

}