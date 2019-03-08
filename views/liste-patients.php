<?php include ('../model/model-patient.php'); ?>
<?php include ('../controller/controller-liste-patients.php'); ?>
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
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Date de Naissance</th>
                        <th>Téléphone</th>
                        <th>Mail</th>
                        <th>Profil</th>
                        <th>Supprimer Profil</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (isset($searchPatients)) {
                        foreach ($searchPatients as $patients) {
                            ?>
                            <tr>
                                <td data-label="Nom"><?= $patients->lastname ?></td>
                                <td data-label="Prénom"><?= $patients->firstname ?></td>
                                <td data-label="Date de Naissance"><?= $patients->birthdate ?></td>
                                <td data-label="Téléphone"><?= $patients->phone ?></td>
                                <td data-label="Mail"><?= $patients->mail ?></td>
                                <td data-label="Profil"><a class="btn btn-primary" href="profil-patient.php?idPatient=<?= $patients->id ?>">Voir detail</a></td>
                                <td data-label="Supprimer Profil"><a class="btn btn-danger" href="liste-patients.php?idPatient=<?= $patients->id ?>">Supprimer</a></td>
                            </tr>
                            <?php
                        }
                    } else {
                        foreach ($patientsList as $patient) {
                            ?>
                            <tr>
                                <td data-label="Nom"><?= $patient->lastname ?></td>
                                <td data-label="Prénom"><?= $patient->firstname ?></td>
                                <td data-label="Date de Naissance"><?= $patient->birthdate ?></td>
                                <td data-label="Téléphone"><?= $patient->phone ?></td>
                                <td data-label="Mail"><?= $patient->mail ?></td>
                                <td data-label="Profil"><a class="btn btn-primary" href="profil-patient.php?idPatient=<?= $patient->id ?>">Voir detail</a></td>
                                <td data-label="Supprimer Profil"><a class="btn btn-danger" href="liste-patients.php?idPatient=<?= $patient->id ?>">Supprimer</a></td>
                            </tr>
                            <?php
                        }
                    }
                    ?>
                </tbody>
            </table>
            <div class="titleSearch">Recherchez Vous dans notre liste de Patients</div>
            <form action="liste-patients.php" method="GET"> 
                <input name="search" id="search" type="text" placeholder="Insérer nom ou prénom" class="search"> 
                <input class=" btn btn-primary" id="submit" type="submit" value="Recherchez-vous"> 
            </form>
            <nav aria-label="Page navigation example">
                <ul class="pagination">
                    <?php for ($nbPage = 1; $nbPage <= $currentPage; $nbPage++):?>                   

                            <li class="page-item"><a class="page-link" href="liste-patients.php?page=<?= $nbPage ?>"><?= $nbPage ?></a></li>

<?php endfor; ?>
                </ul>
            </nav>
        </div>
    </body>
</html>

