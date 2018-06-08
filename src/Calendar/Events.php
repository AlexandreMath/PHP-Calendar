<?php

namespace Calendar;


class Events 
{
    
    private $pdo;

    public function __construct(\PDO $pdo)
    {
        $this->pdo = $pdo;
    }
    
    /**
     * Récupère les évènements commençant entre 2 dates
     * @param \DateTime $start
     * @param \DateTime $end
     * @return Array
     */
    public function getEventsBetween (\DateTime $start, \DateTime $end): Array
    {
        $sql =  "SELECT * FROM events WHERE start BETWEEN '{$start->format('Y-m-d 00:00:00')}' AND '{$end->format('Y-m-d 23:59:59')}' ORDER BY start ASC";
        $statement = $this->pdo->query($sql);
        $results = $statement->fetchAll();
        return $results;
    }
    /**
     * Récupère les évènements commençant entre 2 dates indexé par jour
     * @param \DateTime $start
     * @param \DateTime $end
     * @return Array
     */
    public function getEventsBetweenByDay (\DateTime $start, \DateTime $end): Array
    {
        $events = $this->getEventsBetween($start, $end);
        $days = [];
        foreach ($events as $event) {
            $date = \explode(' ', $event['start'])[0]; 
            if (!isset($days[$date])) {
                $days[$date] = [$event];
            }else {
                $days[$date][] = $event;
            }
        }
        return $days;

    }
    /**
     * Récupère un évènement grâce à son id
     * @param Int $id
     * @return \Calendar\Event
     * @throw \Exception
    */
    public function find(int $id): Event
    {   
        
        $statement = $this->pdo->query("SELECT * FROM events WHERE id = $id LIMIT 1");
        $statement->setFetchMode(\PDO::FETCH_CLASS, Event::class);
        $result = $statement->fetch();
        if ($result === false) {
            throw new \Exception("Aucun résultat n'a été trouvé");
        }
        return $result;
    }

    /**
     * Crée un évènement au niveau de la base de données
     * @param Event $event
     * @return Bool
    */
    public function create(Event $event):Bool
    {
        $statement = $this->pdo->prepare("INSERT INTO events(name, description, start, end) VALUE(?, ?, ?, ?)");
        return $statement->execute([
            $event->getName(),
            $event->getDescription(),
            $event->getStart()->format('Y-m-d H:i:s'),
            $event->getEnd()->format('Y-m-d H:i:s')
        ]);
    }

    /**
     * Met à jour un évènement au niveau de la base de données
     * @param Event $event
     * @return Bool
    */
    public function update(Event $event):Bool
    {
        $statement = $this->pdo->prepare("UPDATE events SET name = ?, description = ?, start = ?, end = ? WHERE id = ?");
        return $statement->execute([
            $event->getName(),
            $event->getDescription(),
            $event->getStart()->format('Y-m-d H:i:s'),
            $event->getEnd()->format('Y-m-d H:i:s'),
            $event->getId()
        ]);
    }

    /**
     * Supprime un évènement au niveau de la base de données via son id
     * @param Event $event
     * @return Bool
    */
    public function delete(Event $event):Bool
    {
        $statement = $this->pdo->prepare("DELETE FROM events WHERE id = ?");
        return $statement->execute([ $event->getId() ]);
    }

    public function hydrate(Event $event, Array $data): Event
    {
        $event->setName($data['name']);
        $event->setDescription($data['description']);
        $event->setStart(\DateTime::createFromFormat('Y-m-d H:i', $data['date'] . ' ' . $data['start'])->format('Y-m-d H:i:s'));
        $event->setEnd(\DateTime::createFromFormat('Y-m-d H:i', $data['date'] . ' ' . $data['end'])->format('Y-m-d H:i:s'));
        return $event;
    }
}