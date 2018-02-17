<?php

namespace Modules\Registrations\Repositories;

use Modules\Registrations\Repositories\Contracts\IPaymentsRepository;
use Modules\Registrations\Entities\Payments;

class PaymentsRepository implements IPaymentsRepository
{

    private $model;

    public function __construct(Payments $model)
    {
        $this->model = $model;
    }

    public function fetch($config = [])
    {
        $payments = $this->model->orderBy('created_at', 'asc');

        if (isset($config['total']) and !empty($config['total'])) {
            return $payments->paginate($config['total']);
        }

        return $payments->get();
    }

    public function fetchById($id)
    {
        return $this->model->find($id);
    }

    public function store($data)
    {
        $newPayment = new $this->model;
        $newPayment->fill($data);
        return $newPayment->save();
    }

    public function update($data, $id)
    {
        $payment = $this->model->find($id);
        return $payment->fill($data)->save();
    }

    public function delete($id)
    {
        $payment = $this->model->find($id);
        return $payment->delete();
    }

    public function storePaymentsToRegistration($registration)
    {
        $course = $registration->course;

        $courseDurationMonths = $course->duration_months;

        $this->store([
            'registration_id' => $registration->id,
            'value_to_pay'    => $course->registration_fee,
            'type'            => 'registration_fee'
        ]);

        for($i = 0 ; $i < $courseDurationMonths ; ++$i) {

            $this->store([
                'registration_id' => $registration->id,
                'value_to_pay'    => $course->monthly_fee,
                'type'            => 'monthly_fee'
            ]);
        }
    }

    public function doPayment($id, $paymentId, $data)
    {
        $payment = $this->fetchById($paymentId);
        $value = number_format(string_to_decimal($data['value']), 2, '.', '');

        $payment->value_paid+= $value;
        if($payment->value_paid >= $payment->value_to_pay) {
            $payment->status = 1;
        }
        return $payment->save();

    }

    public function generateChange($paymentId)
    {
        $payment = $this->fetchById($paymentId);

        if($payment->value_to_pay >= $payment->value_paid) {
            return 'R$ 0.00';
        }
        $changeValue = $payment->value_paid - $payment->value_to_pay;
        $changeNotes = $this->getChangeForBankNote($changeValue);

        return [
            'value' => $changeValue,
            'notes' => $changeNotes
        ];

    }

    private function getChangeForBankNote($value)
    {
        $bankNotesQuantity = [
            "R$ 100,00" => 0,
            "R$ 50,00"  => 0,
            "R$ 10,00"  => 0,
            "R$ 5,00"   => 0,
            "R$ 1,00"   => 0,
            "R$ 0,50"   => 0,
            "R$ 0,10"   => 0,
            "R$ 0,05"   => 0,
            "R$ 0,01"   => 0,

        ];
        while ($value >= 100)
        {
            $bankNotesQuantity["R$ 100,00"]+=1;
            $value-= 100;
        }
        while ($value >= 50)
        {
            $bankNotesQuantity["R$ 50,00"]+=1;
            $value-= 50;
        }
        while ($value >= 10)
        {
            $bankNotesQuantity["R$ 10,00"]+=1;
            $value-= 10;
        }
        while ($value >= 5)
        {
            $bankNotesQuantity["R$ 5,00"]+=1;
            $value-= 5;
        }
        while ($value >= 1)
        {
            $bankNotesQuantity["R$ 1,00"]+=1;
            $value-= 1;
        }
        while ($value >= 0.5)
        {
            $bankNotesQuantity["R$ 0,50"]+=1;
            $value-= 0.5;
        }
        while ($value >= 0.1)
        {
            $bankNotesQuantity["R$ 0,10"]+=1;
            $value-= 0.1;
        }
        while ($value >= 0.05)
        {
            $bankNotesQuantity["R$ 0,05"]+=1;
            $value-= 0.05;
        }
        while ($value >= 0.01)
        {
            $bankNotesQuantity["R$ 0,01"]+=1;
            $value-= 0.01;
        }

        return $bankNotesQuantity;
    }

}