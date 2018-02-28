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

        if(isset($config['isPaid'])) {
            $registrations->where('is_paid', $config['isPaid']);
        }

        if(isset($config['year']) && !empty($config['year'])) {
            $registrations->where('year', $config['year']);
        }

        if (isset($config['total']) and !empty($config['total'])) {
            return $registrations->paginate($config['total'])->appends([
                'student' => $config['student'],
                'course'  => $config['course'],
                'year'    => $config['year'],
                'isPaid'  => $config['isPaid'],
                'enabled' => $config['status']
            ]);
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

            $newRegistration = new $this->model;

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

    public function cancel($id, $data)
    {
        $tax = (isset($data['tax'])) ? $data['tax'] : null;
        $registration = $this->fetchById($id);
        $registration->enabled = 0;
        $registration->cancel_date = date('Y-m-d');
        $payments = $registration->payments;
        foreach($payments as $payment) {
            $payment->delete();
        }
        $this->paymentsRepository->store([
            'registration_id' => $registration->id,
            'value_to_pay'    => $tax,
            'type'            => 'monthly_fee'
        ]);
        $registration->save();
        return $registration;
    }

    public function checkIfAllPaymentsWereDone($registration)
    {
        if($registration) {
            $paymentsUndone = $registration->payments->where('status', false);
            if($paymentsUndone->isEmpty()) {
                $registration->is_paid = true;
                $registration->save();
            }
        }
    }

}