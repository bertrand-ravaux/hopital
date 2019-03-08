<?php include ('../model/model-patient.php'); ?>
<?php include ('../controller/controller-ajout-patient.php'); ?>
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
        <?php include ('navbar.php') ?>

        <form method="POST" action="ajout-patient.php">
            <div class="input-group mb-3">
                <?php if ($isSucess) { ?>
                    <p class="text-success">Validation du Formulaire</p>
                <?php } if ($isError) { ?>
                    <p class="text-danger">Désole le patient n'a pas plus être enregistrée</p>
                <?php } ?>
            </div>
            <div class="form-group">
                <label for="lastname">Nom :</label>
                <input name="lastname" type="text" class="form-control lastName"  placeholder="Bouchard"/>
                <p class="text-danger"><?= isset($formError['lastname']) ? $formError['lastname'] : '' ?></p>
            </div>
            <div class="form-group">
                <label for="firstname">Prénom :</label>
                <input name="firstname" type="text" class="form-control firstName" placeholder="Gerard"/>
                <p class="text-danger"><?= isset($formError['firstname']) ? $formError['firstname'] : '' ?></p>
            </div>
            <div class="form-group">
                <label for="birthdate">Date de Naissance :</label>
                <input type="date" name="birthdate" class="form-control birthdate" placeholder="00/00/000"/>
                <p class="text-danger"><?= isset($formError['birthdate']) ? $formError['birthdate'] : '' ?></p>
            </div>
            <div class="form-group">
                <label for="phone">Téléphone :</label>
                <input type="text" name="phone" class="form-control phone" placeholder="0671234556"/>
                <p class="text-danger"><?= isset($formError['phone']) ? $formError['phone'] : '' ?></p>
            </div>
            <div class="form-group">
                <label for="mail">Mail :</label>
                <input type="text" name="mail" class="form-control mail" placeholder="example@example.com"/>
                <p class="text-danger"><?= isset($formError['mail']) ? $formError['mail'] : '' ?></p>
            </div>
            <button type="submit" class="btn btn-danger" name="submit">Valider!</button>
        </form>
    </body>
</html>

