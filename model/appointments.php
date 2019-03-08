<?php

class appointments {

    public $id = 0;
    public $dateHour = '0000-00-00 00:00:00';
    public $idPatients = 0;
    private $db;

    public function __construct() {
        //protection contre l'erreur
        //si il n'y a pas d'erreur
        try {
            $this->db = new PDO('mysql:host=localhost;dbname=hospitalE2N;charset=utf8', 'ravaux', 'Ravaux.02');
            //si il y a une erreur
        } catch (Exception $ex) {
            $ex->getMessage();
        }
    }

    public function createAppointment() {
        $query = 'INSERT INTO `appointments` ( `dateHour`, `idPatients`) VALUES (:dateHour, :idPatients)';
        $queryResult = $this->db->prepare($query);
        $queryResult->bindValue(':dateHour', $this->dateHour, PDO::PARAM_STR);
        $queryResult->bindValue(':idPatients', $this->idPatients, PDO::PARAM_INT);
        return $queryResult->execute();
    }

    public function checkFreeAppointment() {
        $result = FALSE;
//        verifie que le rendez vous n est pas pris
        $query = 'SELECT COUNT(`id`) AS `takenAppointment` FROM `appointments` WHERE `dateHour`=:dateHour AND `idPatients`=:idPatients';
        $freeAppointment = $this->db->prepare($query);
        $freeAppointment->bindValue(':dateHour', $this->dateHour, PDO::PARAM_STR);
        $freeAppointment->bindValue(':idPatients', $this->idPatients, PDO::PARAM_INT);
        if ($freeAppointment->execute()) {
            $resultObject = $freeAppointment->fetch(PDO::FETCH_OBJ);
            $result = $resultObject->takenAppointment;
        }
        return $result;
    }

    public function getAppointmentList() {
        $query = 'SELECT DATE_FORMAT(`appointments`.`dateHour`, "%d/%m/%Y") AS `date`,'
                . 'DATE_FORMAT(`appointments`.`dateHour`, "%H:%i") AS `hour`,'
                . '`appointments`.`id`,`patients`.`lastname`,`patients`.`firstname`'
                . ' FROM `appointments` LEFT JOIN `patients` ON `appointments`.`idPatients` = `patients`.`id` ORDER BY `lastname` ASC';
        $queryResult = $this->db->query($query);
        return $queryResult->fetchAll(PDO::FETCH_OBJ);
    }

    public function appointmentsDetails() {
        $return = FALSE;
        $isOk = FALSE;
        $query = 'SELECT DATE_FORMAT(`appointments`.`dateHour`, \'%d/%b/%Y\') AS `date`, '
                . 'DATE_FORMAT(`appointments`.`dateHour`, "%Y-%m-%d") AS `dateUS`,'
                . 'DATE_FORMAT(`appointments`.`dateHour`, \'%H:%i\') AS `hour`, '
                . '`appointments`.`id`, `appointments`.`idPatients`, `patients`.`lastname`, `patients`.`firstname` '
                . 'FROM `appointments` LEFT JOIN `patients` ON `appointments`.`idPatients` = `patients`.`id` '
                . 'WHERE `appointments`.`id` = :id';
        $queryResult = $this->db->prepare($query);
        $queryResult->bindValue(':id', $this->id, PDO::PARAM_INT);
        //si la requête est bien executé, on rempli $return (array) avec un objet
        if ($queryResult->execute()) {
            $return = $queryResult->fetch(PDO::FETCH_OBJ);
        }
        //si $return est un objet alors on hydrate
        if (is_object($return)) {
            $this->lastname = $return->lastname;
            $this->firstname = $return->firstname;
            $this->date = $return->date;
            $this->dateUS = $return->dateUS;
            $this->hour = $return->hour;
            $this->idPatients = $return->idPatients;
            $this->id = $return->id;
            $isOk = TRUE;
        }
        return $isOk;
    }

    public function modifyAppointmentSelected() {
        $queryResult = $this->db->prepare('UPDATE `appointments` SET `dateHour` =:dateHour, `idPatients`=:idPatients WHERE `id`= :idAppointement');
        $queryResult->bindValue(':idAppointement', $this->id, PDO::PARAM_INT);
        $queryResult->bindValue(':dateHour', $this->dateHour, PDO::PARAM_STR);
        $queryResult->bindValue(':idPatients', $this->idPatients, PDO::PARAM_INT);
        return $queryResult->execute();
    }

    public function getAppointmentSelect() {
        $query = 'SELECT `appointments`.`id`,'
                . ' DATE_FORMAT(`appointments`.`dateHour`, \'%d/%b/%Y\') AS `date`, '
                . 'DATE_FORMAT(`appointments`.`dateHour`, \'%H:%i\') AS `hour`,'
                . ' `appointments`.`idPatients`'
                . ' FROM `appointments` '
                . ' WHERE `appointments`.`idPatients`=:idPatients';
        $queryResult = $this->db->prepare($query);
        $queryResult->bindValue(':idPatients', $this->idPatients, PDO::PARAM_INT);
        $queryResult->execute();
        return $queryResult->fetchAll(PDO::FETCH_OBJ);
    }
        public function deleteAppointmentSelect() {
        $query = 'DELETE FROM `appointments` '
                . 'WHERE `id`=:idAppointement';
        $queryResult = $this->db->prepare($query);
        $queryResult->bindValue(':idAppointement', $this->id, PDO::PARAM_INT);
        $queryResult->execute();
    }

}
