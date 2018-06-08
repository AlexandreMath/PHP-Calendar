<?php
namespace App;

class Validator 
{
    protected $data;
    protected $errors;

    public function __construct(Array $data = [])
    {
        $this->data = $data;
        $this->errors = [];
    }

    /**
     * @param Array $data
     * @return Array|Bool 
    */
    public function validates(array $data)
    {
        $this->errors = [];
        $this->data = $data;
        return $this->errors;
        
    }
    /**
     * @return Bool 
     */
    public function validate(string $field, string $method, ...$params): Bool
    {
        if (!isset($this->data[$field])) {
            $this->errors[$field] = "Le champs $field n'est pas rempli";
            return false;
        }
        else{
           return call_user_func([$this, $method], $field, ...$params);
        }
    }

    public function minLength(string $field, int $length): Bool
    {
        if (mb_strlen($field) < $length) {
            $this->errors[$field] = "Le champs $field doit avoir plus de $length caractères";
            return false;
        }
        return true;
    }

    public function date(string $field): Bool
    {
        if(\DateTime::createFromFormat('Y-m-d', $this->data[$field]) === false){
            $this->errors[$field] = "La date ne semble pas valide";
            return false;
        }
        return true;
    }

    public function time(string $field): Bool
    {
        if(\DateTime::createFromFormat('H:i', $this->data[$field]) === false){
            $this->errors[$field] = "Le temps ne semble pas valide";
            return false;
        }
        return true;
    }
    public function beforeTime(string $startField, string $endField): Bool
    {
        if ($this->time($startField) && $this->time($endField)) {
            $start = \DateTime::createFromFormat('H:i', $this->data[$startField]);
            $end = \DateTime::createFromFormat('H:i', $this->data[$endField]);
            if ($start->getTimestamp() > $end->getTimestamp()) {
                $this->errors[$startField] = "Le temps doit être inférieur au temps de fin!";
                return false;
            }
            return true;
        }
        return false;
    }

}
