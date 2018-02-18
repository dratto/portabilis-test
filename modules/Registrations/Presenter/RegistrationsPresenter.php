<?php

namespace Modules\Registrations\Presenters;

use Pingpong\Presenters\Presenter;
use Carbon\Carbon;

class RegistrationsPresenter extends Presenter
{

    public function enabled()
    {
        if($this->getEntity()->enabled) {
            return 'Ativa';
        }
        return 'Cancelada';
    }

    public function isPaid()
    {
        if($this->getEntity()->isPaid()) {
            return 'Paga';
        }
        return 'Pagamento pendente';
    }

    public function createdAt()
    {
        if ($this->created_at instanceof Carbon) {
            return $this->created_at->format('d/m/Y H:i:s');
        }
        return '';
    }

    public function cancelDate()
    {
        if ($this->getEntity()->cancel_date) {
            return date('d/m/Y', strtotime($this->getEntity()->cancel_date));
        }
        return '';
    }

}