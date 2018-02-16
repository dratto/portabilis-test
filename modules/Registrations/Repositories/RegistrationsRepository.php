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

        $registrations->where('enabled', isset($config['status']) ? intval($config['status']) : 1);

        if(isset($config['student']) && !empty($config['student'])) {
            $registrations->whereHas('student', function($query) use($config) {
                return $query->where('name', 'like', '%' . $config['student']. '%');
            });
        }

        if(isset($config['course']) && !empty($config['course'])) {
            $registrations->whereHas('course', function($query) use($config) {
               return $query->where('name', 'like', '%' . $config['course'] . '%');
            });
        }

        if(isset($config['year']) && !empty($config['year'])) {
            $registrations->whereYear('created_at', '=', $config['year']);
        }

        if(isset($config['isPaid']) && !empty($config['isPaid'])) {
            $registrations->where('is_paid', $config['isPaid']);
        }

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