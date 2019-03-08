<?php
$appointment= new appointments();
if (!empty($_GET['idAppointement'])) {
    $appointment->id = htmlspecialchars($_GET['idAppointement']);
    $appointment->deleteAppointmentSelect();
}
$appointmentsList=$appointment->getAppointmentList();
