<?php
include ('../model/appointments.php');
include ('../model/model-patient.php');
include ('../controller/controller-ajout-rendezvous.php');
include ('navbar.php');
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8"/>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"/>
        <link rel="stylesheet" href="assets/css/style.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans"/>
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
        <title>Hopital la manu</title>
    </head>
    <body>
        <div class="container-fluid">
            <div class="col-xs-12 col-md-12 col-sm-12 col-lg-12 col-xl-12">
                <div class="row">
                    <p class="text-danger"><?= isset($formError['checkAppointment']) ? $formError['checkAppointment'] : '' ?></p>
                    <form method="POST" action="ajout-rendezvous.php" class="form">
                        <?php if ($isSuccess) { ?>
                            <p class="text-success">Votre rendez-vous a bien été prises en compte</p>
                            <?php
                        }
                        if ($isError) {
                            ?>
                            <p class="text-danger">Désolé, votre rendez-vous n'a pu être enregistré !</p>
                            <?php
                        }
                        ?>
                        <fieldset>
                            <legend>Ajouter un rendez-Vous</legend>
                            <label for="idLastname"> Nom et prénom : </label>
                            <select name="idLastname" id="idLastname">
                                <option value="">Choix du patient</option>
                                <?php foreach ($patientsList as $patientDetail) { ?>
                                    <option value = "<?= $patientDetail->id ?>"><?= $patientDetail->lastname . ' ' . $patientDetail->firstname ?></option>
                                <?php } ?>
                            </select>
                            <p class="text-danger"><?= isset($formError['patient']) ? $formError['patient'] : '' ?></p>
                            <label for="date"> Date du rendez-vous : </label><input type="date" class="date" name="date" value="<?= isset($date) ? $date : '' ?>"/>
                            <p class="text-danger"><?= isset($formError['date']) ? $formError['date'] : '' ?></p> 
                            <p><label for="hour">Heure du rendez-vous (heures d'ouverture 08:00 à 20:00) : </label><input class="hour" type="time" name="hour" min="08:00" max="20:00" value="<?= isset($hour) ? $hour : '' ?>"/></p>
                            <div>
                                <div class="nav-item">
                                    <input type="submit" class="valid" value="Valider" name="submit"/></a>
                                </div>
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>
            <div class="raw">
                <p>Liste des rendez-vous : </p>
                <a href="appointments-list.php" class="btn btn-danger">liste des rendez-vous</a>
            </div>
        </div>
    </body>
</html>
