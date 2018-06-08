<?php
namespace Calendar;

use App\Validator;

class EventValidator extends Validator
{
    /**
     * @param Array $data
     * @return Array|Bool 
    */
    public function validates(array $data)
    {
        parent::validates($data);
        $this->validate('name','minLength',3);
        $this->validate('date','date');
        $this->validate('start','beforeTime', 'end');
        return $this->errors;
    }
}