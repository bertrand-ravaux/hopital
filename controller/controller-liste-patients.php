<?php

$regexName = '/^[a-zA-Z\- ]+$/';

//Instenciation de l'objet patients. 
//$patients devient une instance de la classe patients.
//la methode magique construct est appelée automatiquement 
//grace au mot clé new.
$patients = new patients();
if (!empty($_GET['idPatient'])) {
    $patients->id = htmlspecialchars($_GET['idPatient']);
    $patients->deletePatientSelect();
} else if (!empty($_GET['search'])) {
    if (preg_match($regexName, $_GET['search'])) {
        $patients->lastname = htmlspecialchars($_GET['search']);
        $patients->firstname = htmlspecialchars($_GET['search']);
        $searchPatients = $patients->getSearchByName();
    }
}
$start = 5;
$currentPage = $patients->calCountNbPatient();
$currentPage = ceil($currentPage->countPatient / $start);
if (!empty($_GET['page'])) {
    if (!is_numeric($_GET['page']) || $_GET['page'] > $currentPage || $_GET['page']<= 0){
        $page=1;
    }else{
        $page = $_GET['page']; 
    }   
} else {
    $page=1;    
}
$interval = ($page -1) * $start;
$patientsList = $patients->paging($start, $interval);
?>

