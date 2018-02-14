<?php

namespace Modules\Students\Entities;

use Illuminate\Database\Eloquent\Model;

class Students extends Model
{

    protected $table = 'students';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'cpf',
        'rg',
        'date_of_birth',
        'phone',
    ];

    public function setCPFAttribute($value)
    {
        $this->attributes['cpf'] = numbers_only($value);
    }
}
