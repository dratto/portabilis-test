<?php

namespace Modules\Registrations\Repositories;

use Exception;
use Log;
use DB;
use Modules\Registrations\Repositories\Contracts\IRegistrationsRepository;
use Modules\Registrations\Repositories\Contracts\IPaymentsRepository;
use Modules\Registrations\Entities\Registrations;

class RegistrationsRepository implements IRegistrationsRepository
{
    private $model;

    private $paymentsRepository;

    public function __construct(Registrations $model, IPaymentsRepository $paymentsRepository)
    {
        $this->model              = $model;
        $this->paymentsRepository = $paymentsRepository;
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

        if(isset($config['isPaid']) && $config['isPaid']) {
            $registrations->whereHas('payments', function($query) use($config) {
                return $query->where('status', $config['isPaid']);
            });
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
        try {
            DB::beginTransaction();

            $newRegistration = $this->model;

            $newRegistration->fill($data);
            $newRegistration->save();


            $this->paymentsRepository->storePaymentsToRegistration($newRegistration);


            DB::commit();

            return $newRegistration;

        } catch(Exception $e) {
            DB::rollback();
            Log::error($e->getMessage() . ' ' . $e->getLine());
            return false;
        }
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

    public function getTaxForCancel($registration)
    {
        $payments = $registration->payments;
        $tax = 0;
        foreach($payments as $payment) {
            if(! $payment->status) {
                $tax = ($payment->value_to_pay * 0.01);
            }
        }
        return $tax;
    }

    public function cancel($id)
    {
        $registration = $this->fetchById($id);
        $registration->enabled = 0;
        $registration->cancel_date = date('Y-m-d');
        $registration->save();
        return $registration;
    }

}