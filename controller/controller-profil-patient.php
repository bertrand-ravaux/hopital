<?php

$formError = array();
$regexBirthdate = '/^[0-9]{4}-[0-9]{1,2}-[0-9]{1,2}$/';
$regexMail = '/^[a-z0-9 ._-]+\@[a-z]+\.[a-z]{2,4}$/';
$regexName = '/^[a-zA-Zéèêçîô \'-]+$/';
$regexPhone = '/^[0-9\-\s\/]{0,14}$/';
$isSucess = FALSE;
$isError = FALSE;


if (isset($_POST['submit'])) {
    if (!empty($_POST['lastname'])) {
        if (preg_match($regexName, $_POST['lastname'])) {
            $lastname = htmlspecialchars($_POST['lastname']);
        } else {
            $formError['lastname'] = 'Saisie invalide';
        }
    } else {
        $formError['lastname'] = 'le champs est vide';
    }
    if (!empty($_POST['firstname'])) {
        if (preg_match($regexName, $_POST['firstname'])) {
            $firstname = htmlspecialchars($_POST['firstname']);
        } else {
            $formError['firstname'] = 'Saisie invalide';
        }
    } else {
        $formError['firstname'] = 'le champs est vide';
    }
    if (!empty($_POST['birthdate'])) {
        if (preg_match($regexBirthdate, $_POST['birthdate'])) {
            $birthdate = htmlspecialchars($_POST['birthdate']);
        } else {
            $formError['birthdate'] = 'Saisie invalide';
        }
    } else {
        $formError['birthdate'] = 'le champs est vide';
    }
    if (!empty($_POST['phone'])) {
        if (preg_match($regexPhone, $_POST['phone'])) {
            $phone = htmlspecialchars($_POST['phone']);
        } else {
            $formError['phone'] = 'Saisie invalide';
        }
    } else {
        $formError['phone'] = 'le champs est vide';
    }
    if (!empty($_POST['mail'])) {
        if (preg_match($regexMail, $_POST['mail'])) {
            $mail = htmlspecialchars($_POST['mail']);
        } else {
            $formError['mail'] = 'Saisie invalide';
        }
    } else {
        $formError['mail'] = 'le champs est vide';
    }
    if (count($formError) == 0) {
        $patients = new patients();
        $patients->id = $_GET['idPatient'];
        $patients->lastname = $lastname;
        $patients->firstname = $firstname;
        $patients->birthdate = $birthdate;
        $patients->phone = $phone;
        $patients->mail = $mail;
        if ($patients->modifyPatientSelected()) {
            $isSucess = TRUE;
        } else {
            $isError = TRUE;
        }
    }
}
$patient = new patients();
$patient->id = $_GET['idPatient'];
$patientInfo = $patient->getPatientSelect();
$appointment= new appointments();
$appointment->idPatients = $_GET['idPatient'];
$appointmentList=$appointment->getAppointmentSelect();
?>

