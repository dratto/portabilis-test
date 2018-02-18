<?php

namespace Modules\Registrations\Entities;

use Pingpong\Presenters\Model;

class Registrations extends Model
{

    protected $table = 'registration';

    protected $presenter = 'Modules\Registrations\Presenters\RegistrationsPresenter';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'student_id',
        'course_id',
        'enabled',
        'cancel_date',
        'year'
    ];

    public function student()
    {
        return $this->belongsTo('Modules\Students\Entities\Students', 'student_id');
    }

    public function course()
    {
        return $this->belongsTo('Modules\Courses\Entities\Courses', 'course_id');
    }

    public function payments()
    {
        return $this->hasMany('Modules\Registrations\Entities\Payments', 'registration_id');
    }

    public function isPaid()
    {
        $payments = $this->payments;
        foreach($payments as $payment) {
            if(! $payment->status) {
                return false;
            }
        }
        return true;
    }
}
