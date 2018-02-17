<?php

namespace Modules\Registrations\Presenters;

use Pingpong\Presenters\Presenter;

class PaymentsPresenter extends Presenter
{

    public function type()
    {
        if($this->getEntity()->type === 'registration_fee') {
            return 'Matrícula';
        }
        return 'Mensalidade';
    }

    public function valueToPay()
    {
        return format_to_money($this->getEntity()->value_to_pay);
    }

    public function valuePaid()
    {
        return format_to_money($this->getEntity()->value_paid);
    }

    public function status()
    {
        if($this->getEntity()->status) {
            return 'Pago';
        }
        return 'Não pago';
    }

}