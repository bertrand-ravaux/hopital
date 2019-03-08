<?php include ('../model/model-patient.php'); ?>
<?php include ('../model/appointments.php'); ?>
<?php include ('../controller/controller-profil-patient.php'); ?>
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
        <?php include ('navbar.php') ?>
        <?php if ($isSucess){ ?>
        <p class="text-success">Patient Modifié</p>
        <?php } if ($isError){ ?>
        <p class="text-danger">Désole le patient n'a pas plus étre modifiée</p>
        <?php } ?> 
        <form method="POST" action="#">
            <div class="input-group mb-3">
            </div>
            <div class="form-group">
                <label for="lastname">Nom :</label>
                <input name="lastname" type="text" class="form-control lastName"  value="<?= $patientInfo->lastname ?>"/>
                <p class="text-danger"><?= isset($formError['lastname']) ? $formError['lastname'] : ''?></p>
            </div>
            <div class="form-group">
                <label for="firstname">Prénom :</label>
                <input name="firstname" type="text" class="form-control firstName" value="<?= $patientInfo->firstname ?>"/>
                <p class="text-danger"><?= isset($formError['firstname']) ? $formError['firstname'] : ''?></p>
            </div>
            <div class="form-group">
                <label for="birthdate">Date de Naissance :</label>
                <input type="date" name="birthdate" class="form-control birthdate" value="<?= $patientInfo->birthdate ?>"/>
                <p class="text-danger"><?= isset($formError['birthdate']) ? $formError['birthdate'] : ''?></p>
            </div>
            <div class="form-group">
                <label for="phone">Téléphone :</label>
                <input type="text" name="phone" class="form-control phone" value="<?= $patientInfo->phone ?>"/>
                <p class="text-danger"><?= isset($formError['phone']) ? $formError['phone'] : ''?></p>
            </div>
            <div class="form-group">
                <label for="mail">Mail :</label>
                <input type="email" name="mail" class="form-control mail" value="<?= $patientInfo->mail ?>"/>
                <p class="text-danger"><?= isset($formError['mail']) ? $formError['mail'] : ''?></p>
            </div>
            <button type="submit" class="btn btn-danger" name="submit">Modifier!</button>
        </form>
        <div class="container-fluid">
            <h1 class="titleRdv">Vos rendez-vous:</h1>
            <table>
                <thead>
                    <tr>
                        <th>Date du rendez-vous</th>
                        <th>Heure du rendez-vous</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($appointmentList as $appointment) { ?>
                        <tr>
                            <td data-label="Date du rendez-vous"><?= $appointment->date ?></td>
                            <td data-label="Heure du rendez-vous"><?= $appointment->hour ?></td>
                        </tr>
                    <?php } ?>                   
                </tbody>
            </table>
        </div>
    </body>
</html>