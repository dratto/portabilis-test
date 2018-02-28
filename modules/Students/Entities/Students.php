<?php

namespace Modules\Students\Entities;

use Pingpong\Presenters\Model;

class Students extends Model
{

    protected $table = 'students';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
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

    public function setPhoneAttribute($value)
    {
        $this->attributes['phone'] = numbers_only($value);
    }

    public function getCpfAttribute()
    {
        $cpf = $this->attributes['cpf'];

        if (empty($cpf)) {
            return '';
        }
        return mask('###.###.###-##', $cpf);
    }

    public function setDateOfBirthAttribute($value)
    {
        if(!empty($value)) {
            $date = explode('/', $value);
            if(isset($date[2])) {
                $date = $date[2] . '-' . $date[1] . '-' . $date[0];
                return $this->attributes['date_of_birth'] = $date;
            }
            $this->attributes['date_of_birth'] = $value;
        }
    }

    public function getDateOfBirthAttribute()
    {
        return date('d/m/Y', strtotime($this->attributes['date_of_birth']));
    }

    public function registrations()
    {
        return $this->hasMany('Modules\Registrations\Entities\Registrations', 'student_id');
    }
}
