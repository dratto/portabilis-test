<?php

namespace Modules\Courses\Repositories\Contracts;


interface ICoursesRepository
{
    public function fetch($config = []);
    public function fetchById($id);
    public function store($data);
    public function update($data, $id);
    public function delete($id);

}