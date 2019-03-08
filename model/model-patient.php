<?php

class patients {

    public $id = 0;
    public $lastname = '';
    public $firstname = '';
    public $birthdate = '00/00/0000';
    public $phone = 'OOOOOOOOOO';
    public $mail = '';
    public $intervalPatient = 5;
    private $db;

    public function __construct() {
        try {
            $this->db = new PDO('mysql:host=localhost;dbname=hospitalE2N;charset=utf8', 'ravaux', 'Ravaux.02');
        } catch (Exception $ex) {
            $ex->getMessage();
        }
    }

    /**
     * methode permettant de créer un patient
     * @return array
     */
    public function createPatient() {
        $query = 'INSERT INTO `patients` ( `lastname`, `firstname`, `birthdate`, `phone`, `mail`) VALUES (:lastname, :firstname, :birthdate, :phone, :mail)';
        $queryResult = $this->db->prepare($query);
        $queryResult->bindValue(':lastname', $this->lastname, PDO::PARAM_STR);
        $queryResult->bindValue(':firstname', $this->firstname, PDO::PARAM_STR);
        $queryResult->bindValue(':birthdate', $this->birthdate, PDO::PARAM_STR);
        $queryResult->bindValue(':phone', $this->phone, PDO::PARAM_STR);
        $queryResult->bindValue(':mail', $this->mail, PDO::PARAM_STR);
        return $queryResult->execute();
    }

    public function getPatientsList() {
        $result = array();
        $query = 'SELECT `id`,`lastname`,`firstname`,DATE_FORMAT (`birthdate`, "%d/%m/%Y") AS `birthdate`,`phone`,`mail` FROM `patients` ORDER BY `lastname` ASC';
        $queryResult = $this->db->query($query);
        if (is_object($queryResult)) {
            $result = $queryResult->fetchAll(PDO::FETCH_OBJ);
        }
        return $result;
    }

    public function getPatientSelect() {
        $query = 'SELECT `id`,`lastname`,`firstname`, `birthdate`,`phone`,`mail` FROM `patients` WHERE `id`=:id';
        $queryResult = $this->db->prepare($query);
        $queryResult->bindValue(':id', $this->id, PDO::PARAM_INT);
        $queryResult->execute();
        return $queryResult->fetch(PDO::FETCH_OBJ);
    }

    public function modifyPatientSelected() {
        $query = 'UPDATE `patients` SET `lastname` = :lastname, `firstname` = :firstname, `birthdate` = :birthdate, `phone` = :phone, `mail` = :mail WHERE `id` = :id';
        $queryResult = $this->db->prepare($query);
        $queryResult->bindValue(':id', $this->id, PDO::PARAM_INT);
        $queryResult->bindValue(':lastname', $this->lastname, PDO::PARAM_STR);
        $queryResult->bindValue(':firstname', $this->firstname, PDO::PARAM_STR);
        $queryResult->bindValue(':birthdate', $this->birthdate, PDO::PARAM_STR);
        $queryResult->bindValue(':phone', $this->phone, PDO::PARAM_STR);
        $queryResult->bindValue(':mail', $this->mail, PDO::PARAM_STR);
        return $queryResult->execute();
    }

    public function deletePatientSelect() {
        $query = 'DELETE FROM `patients` '
                . 'WHERE `id`=:idPatient';
        $queryResult = $this->db->prepare($query);
        $queryResult->bindValue(':idPatient', $this->id, PDO::PARAM_INT);
        $queryResult->execute();
    }

    public function getSearchByName() {
        $query = 'SELECT * FROM `patients` WHERE `lastname` LIKE :search OR `firstname` LIKE :search';
        $queryResult = $this->db->prepare($query);
        $queryResult->bindValue(':search', '%' . $this->lastname . '%', PDO::PARAM_STR);
        $queryResult->bindValue(':search', '%' . $this->firstname . '%', PDO::PARAM_STR);
        $queryResult->execute();
        $result = $queryResult->fetchAll(PDO::FETCH_OBJ);
        return $result;
    }

    public function paging($start, $interval) {
        $result = array();
        $query = 'SELECT `id`,`lastname`,`firstname`,DATE_FORMAT (`birthdate`, "%d/%m/%Y") AS `birthdate`,`phone`,`mail` FROM `patients` LIMIT :start OFFSET :interval';
        $queryResult = $this->db->prepare($query);
        $queryResult->bindValue(':start', $start, PDO::PARAM_INT);
        $queryResult->bindValue(':interval', $interval, PDO::PARAM_INT);
        if ($queryResult->execute()) {
            if (is_object($queryResult)) {
                $result = $queryResult->fetchAll(PDO::FETCH_OBJ);
            } else {
                $result = FALSE;
            }
        }else{
            $result = FALSE;            
        }
        return $result;
    }

    public function calCountNbPatient() {
        $query = 'SELECT COUNT(`id`) AS countPatient FROM `patients`';
        $result = $this->db->query($query);
        if (is_object($result)) {
            $queryResult = $result->fetch(PDO :: FETCH_OBJ);
        } else {
            $queryResult = FALSE;
        }
        return $queryResult;
    }

}

?>