<?php

namespace Modules\Registrations\Repositories\Contracts;


interface IRegistrationsRepository
{
    public function fetch($config);
    public function fetchById($id);
    public function store($data);
    public function update($data, $id);
    public function delete($id);

}