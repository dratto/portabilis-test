<?php

namespace Modules\Registrations\Entities;

use Pingpong\Presenters\Model;

class Payments extends Model
{

    protected $table = 'payments';

    protected $presenter = 'Modules\Registrations\Presenters\PaymentsPresenter';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'registration_id',
        'type',
        'value_to_pay',
        'value_paid',
        'status',
        'deadline'
    ];

}
