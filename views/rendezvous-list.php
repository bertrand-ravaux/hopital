<?php include ('../model/appointments.php'); ?>
<?php include ('../controller/controller-rendezvous-list.php'); ?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8"/>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"/>
        <link rel="stylesheet" href="assets/css/style.css"/>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans"/>
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    </head>
    <body>
        <?php include ('navbar.php'); ?>
        <div class="container-fluid">
            <table>
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Heure</th>
                        <th>Prénom</th>
                        <th>Nom</th>
                        <th>Voir le Détails</th>
                        <th>Supprimer un rendez-vous</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($appointmentsList as $appointment) : ?>
                        <tr>
                            <td data-label="Date"><?= $appointment->date ?></td>
                            <td data-label="Heure"><?= $appointment->hour ?></td>
                            <td data-label="Prénom"><?= $appointment->firstname ?></td>
                            <td data-label="Nom"><?= $appointment->lastname ?></td>
                            <td data-label="Voir le détails"><a class="btn btn-primary" href="rendez-vous.php?id=<?= $appointment->id ?>">Détails</a></td>
                            <td data-label="Supprimer un rendez-vous"><a class="btn btn-danger" href="rendezvous-list.php?idAppointement=<?= $appointment->id ?>">Supprimer</a></td>
                        </tr>
                    <?php endforeach; ?>                   
                </tbody>
            </table>
        </div>
    </body>
</html>
