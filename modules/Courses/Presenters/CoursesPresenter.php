<?php

namespace Modules\Courses\Presenters;


use Pingpong\Presenters\Presenter;

class CoursesPresenter extends Presenter
{

    public function period()
    {
        switch ($this->getEntity()->period) {
            case 'morning':
                return 'Matutino';
            break;
            case 'afternoon':
                return 'Vespertino';
            break;
            case 'night':
                return 'Noturno';
            break;
        }
    }

    public function registrationFee()
    {
        return 'R$ '. number_format($this->getEntity()->registration_fee, 2, ',', '.');
    }

    public function monthlyFee()
    {
        return 'R$ '. number_format($this->getEntity()->monthly_fee, 2, ',', '.');
    }

}