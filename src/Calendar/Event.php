<?php
namespace Calendar;

class Event 
{
    private $id;

    private $name;

    private $description;

    private $start;

    private $end;
    

    /**
     * Get the value of id
     * @return Int
     */ 
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Get the value of name
     * @return String
     */ 
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Get the value of description
     * @return String
     */ 
    public function getDescription(): string
    {
        return $this->description ?? '';
    }

    /**
     * Get the value of start
     * @return \DateTime
     */ 
    public function getStart(): \DateTime
    {
        return new \DateTime($this->start);
    }

    /**
     * Get the value of end
     * @return \DateTime
     */ 
    public function getEnd(): \DateTime
    {
        return new \DateTime($this->end);
    }

    /**
     * Set the value of name
     */ 
    public function setName(string $name)
    {
        $this->name = $name;

    }

    /**
     * Set the value of description
     */ 
    public function setDescription(string $description)
    {
        $this->description = $description;
    }

    /**
     * Set the value of start
     */ 
    public function setStart(string $start)
    {
        $this->start = $start;

    }

    /**
     * Set the value of end
     */ 
    public function setEnd(string $end)
    {
        $this->end = $end;
    }
}
?>