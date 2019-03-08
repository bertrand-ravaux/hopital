<?php

$appointments = new appointments();
if (!empty($_GET['id'])) {
    $appointments->id = htmlspecialchars($_GET['id']);
    $appointmentsDetails = $appointments->appointmentsDetails();
}
$patients = new patients();
$patientsList = $patients->getPatientsList();


$formError = array();
$isSuccess = FALSE;
$isError = FALSE;
$regexDate = '/[0-9]{4}-[0-9]{2}-[0-9]{2}/';
$regexHour = '/(0[0-9]|1[0-9]|2[0-3]):[0-5][0-9]$/';

if (isset($_POST['submit'])) {
    //si $_POST['idPatients'] existe
    if (isset($_POST['idPatients'])) {
        //si $_POST['idPatients'] n'est pas vide
        if (!empty($_POST['idPatients'])) {
            $idPatients = htmlspecialchars($_POST['idPatients']);
            //sinon on stock un message dans le tableau formError
        } else {
            $formError['idPatients'] = 'Erreur, veuillez sélectionnez un patient.';
        }
    }
    if (!empty($_POST['date'])) {
        if (preg_match($regexDate, $_POST['date'])) {
            $date = htmlspecialchars($_POST['date']);
        } else {
            $formError['date'] = 'Saisie invalide';
        }
    } else {
        $formError['date'] = 'le champs est vide';
    }
    if (!empty($_POST['hour'])) {
        if (preg_match($regexHour, $_POST['hour'])) {
            $hour = htmlspecialchars($_POST['hour']);
        } else {
            $formError['hour'] = 'Saisie invalide';
        }
    } else {
        $formError['hour'] = 'le champs est vide';
    }
    //on vérifie qu'il n'y a aucune erreur
    if (count($formError) == 0) {
        $appointments->id = $_GET['id'];
        $appointments->dateHour = $date . ' ' . $hour;
        $appointments->idPatients = $idPatients;
        $chekAppointments = $appointments->checkFreeAppointment();
        if ($chekAppointments === '1') {
            $formError['checkAppointments'] = 'Ce rendez vous n\'est plus disponible';
        } else if ($chekAppointments === '0') {
            $isSuccess = $appointments->modifyAppointmentSelected();
            $appointments = new appointments();
            header('location:rendez-vous.php?id=' . $_GET['id']);
        } else {
            $formError['checkAppointments'] = 'Une erreur est survenue, nous ne pouvons traiter votre demande';
        }
    }
}

