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

}