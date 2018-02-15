<?php

namespace Modules\Registrations\Repositories;

use Modules\Registrations\Repositories\Contracts\IRegistrationsRepository;
use Modules\Registrations\Entities\Registrations;

class RegistrationsRepository implements IRegistrationsRepository
{
    private $model;

    public function __construct(Registrations $model)
    {
        $this->model = $model;
    }

    public function fetch($config)
    {
        $registrations = $this->model->orderBy('created_at', 'desc');

        if (isset($config['total']) and !empty($config['total'])) {
            return $registrations->paginate($config['total']);
        }

        return $registrations->get();
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
        $registration = $this->model->find($id);
        return $registration->fill($data)->save();

    }

    public function delete($id)
    {
        $registration = $this->model->find($id);
        return $registration->delete();
    }

}