<?php

namespace App\Date;

class Month
{
    public $days = ['Lundi','Mardi','Mercredi','Jeudi','Vendredi','Samedi','Dimanche'];

    private $months = ['Janvier','Février','Mars','Avril','Mai','Juin','Juillet','Août','Septembre','Octobre','Novembre','Décembre'];

    public $month;

    public $year;

    /**
     * @param int $month -> Le mois compris entre 1 et 12
     * @param int $year -> L'année
     * @throws Exception
    */
    public function __construct(?int $month = null, ?int $year = null)
    {
        if($month === null || $month < 1 || $month > 12){
            $month = intval(date('m'));
        }
        if($year === null || $month < 1 || $month > 12){
            $year = intval(date('Y'));
        }
        $this->month = $month;
        $this->year = $year;
    }

    /**
     * Revoie le premier jour du mois.
     * @return DateTime
    */
    public function getStartingDay():\DateTime
    {
        return new \DateTime("{$this->year}-{$this->month}-01");
    }

    /**
     * Retourne le mois en toute lettre.
     * @return string
    */
    public function toString(): string
    {
       return $this->months[$this->month - 1] . ' ' . $this->year;
    }

    /**
     * Calcule le nombre de semaine du mois selectionné et le retourne.
     * @return int
    */
    public function getWeeks(): int
    {
        $start = $this->getStartingDay();
        $end = (clone $start)->modify('+1 month -1 day');

        $weeks =  intval($end->format('W')) - intval($start->format('W'))+1;
        if($weeks < 0){
            $weeks =  intval($end->format('W'));
        }
        return $weeks;
    }

    /**
     * Vérifie que le jour est dans le mois en cours.
     * @param \DateTime $date
     * @return bool
    */
    public function withinMonth(\DateTime $date): bool
    {
        return $this->getStartingDay()->format('Y-m') === $date->format('Y-m');
    }

     /**
     * Incrémente de UN le mois. Si le mois corespond à 12 alors c'est l'année qui est incrémentée.
     * @return Month
    */
    public function nextMonth(): Month
    {
       $month = $this->month +1;
       $year = $this->year;
       if($month > 12){
            $month = 1;
            $year += 1;
       }
       return new Month($month, $year);
    }

         /**
     * Décrémente de UN le mois. Si le mois corespond à 1 alors c'est l'année qui est décrémentée.
     * @return Month
    */
    public function previousMonth(): Month
    {
       $month = $this->month -1;
       $year = $this->year;
       if($month < 1){
            $month = 12;
            $year -= 1;
       }
       return new Month($month, $year);
    }
}

?>