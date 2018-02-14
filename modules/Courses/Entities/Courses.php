<?php

namespace Modules\Courses\Entities;

use Pingpong\Presenters\Model;

class Courses extends Model
{

    protected $table = 'courses';

    protected $presenter = 'Modules\Courses\Presenters\CoursesPresenter';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'monthly_fee',
        'registration_fee',
        'period',
        'duration_months'
    ];
}
