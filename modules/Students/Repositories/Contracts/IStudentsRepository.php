<?php

namespace Modules\Students\Repositories\Contracts;


interface IStudentsRepository
{
    public function fetch($config);
    public function fetchById($id);
    public function store($data);
    public function update($data, $id);
    public function delete($id);

}