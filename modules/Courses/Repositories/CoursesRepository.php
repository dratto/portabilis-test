<?php

namespace Modules\Courses\Repositories;

use Modules\Courses\Repositories\Contracts\ICoursesRepository;
use Modules\Courses\Entities\Courses;

class CoursesRepository implements ICoursesRepository
{
    private $model;

    public function __construct(Courses $model)
    {
        $this->model = $model;
    }

    public function fetch($config = [])
    {
        $courses = $this->model->orderBy('created_at', 'desc');

        if (isset($config['total']) and !empty($config['total'])) {
            return $courses->paginate($config['total']);
        }

        return $courses->get();
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
        $course = $this->model->find($id);
        return $course->fill($data)->save();

    }

    public function delete($id)
    {
        $course = $this->model->find($id);
        return $course->delete();
    }

}