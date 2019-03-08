<?php
include '../model/appointments.php';
include '../model/model-patient.php';
include '../controller/controller-rendezvous.php';
include 'navbar.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8"/>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"/>
        <link rel="stylesheet" href="assets/css/style.css"/>
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    </head>
    <body>
        <div class="container-fluid">
            <div class="row">
                <div class="text-center col-12">
                    <h1>Détails du rendez-vous :</h1>
                    <table>
                        <thead>
                            <tr>
                                <th>Nom</th>
                                <th>Prénom</th>
                                <th>Date</th>
                                <th>Heure</th>
                                <th>Id patient</th>
                                <th>Id rdv</th>
                            </tr>
                        </thead>
                        <?php if ($appointmentsDetails) { ?>
                            <tbody>
                                <tr>
                                    <td data-label="Nom"><?= $appointments->lastname ?></td>
                                    <td data-label="Prénom"><?= $appointments->firstname ?></td>
                                    <td data-label="Date"><?= $appointments->date ?></td>
                                    <td data-label="Heure"><?= $appointments->hour ?></td>
                                    <td data-label="Id patient"><?= $appointments->idPatients ?></td>
                                    <td data-label="Id rdv"><?= $appointments->id ?></td>
                                </tr>
                            </tbody>
                        </table>
                    <?php } else { ?>
                        <div class="text-danger">Le rendez-vous n'a pas été trouvé !</div>
                    <?php } ?>
                </div>
            </div>
        </div>
        <div class="col-md-6 text-center">
            <h1>Informations du rendez-vous:</h1>
            <p class="text-danger"><?= isset($formError['checkAppointments']) ? $formError['checkAppointments'] : '' ?></p>
            <form name="form" method="POST" action="rendez-vous.php?id=<?= $appointments->id ?>" enctype="multipart/form-data">
                <label for="idPatients">Nom du patient</label>
                <select name="idPatients" class="form-control">
                    <?php foreach ($patientsList as $patient) { ?>
                        <!-- Si l'id du rdv existe et que l'id du patient est égale à l'id patient du rdv alors je rajoute l'attribut selected  -->
                        <option value="<?= $patient->id ?>" <?= isset($appointments->idPatients) && ($patient->id == $appointments->idPatients) ? 'selected' : '' ?>><?= $patient->lastname . ' ' . $patient->firstname ?></option>
                    <?php } ?>
                </select>
                <p class="text-danger"><?= isset($formError['idPatients']) ? $formError['idPatients'] : '' ?></p>
                <p><strong>Date:</strong><input type="date" class="form-control"   value="<?= $appointments->dateUS ?>" name="date" placeholder="<?= $appointments->date ?>"/>
                    <p class="text-danger"><?= isset($formError['date']) ? $formError['date'] : '' ?></p>
                <p><strong>Heure:</strong><input type="time" class="form-control" title="<?= $appointments->hour ?>" value="<?= $appointments->hour ?>" name="hour" placeholder="<?= $appointments->hour ?>"/>
                    <p class="text-danger"><?= isset($formError['hour']) ? $formError['hour'] : '' ?></p>
                <button type="submit" class="btn btn-primary mt-3" value="valider" name="submit">Valider</button>
            </form>
        </div>
    </body>
</html>
