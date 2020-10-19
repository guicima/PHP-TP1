<?php
require 'elements' . DIRECTORY_SEPARATOR . 'auth.php';
forceConnection();
$title = 'Dashboard';

require 'elements' . DIRECTORY_SEPARATOR . 'header.php';
$currentYear = date("Y");
$currentMonth = date("m");
$selectedYear = isset($_GET['annee']) ? (int)$_GET['annee'] : $currentYear;
$selectedMonth = isset($_GET['mois']) ? $_GET['mois'] : '0';
$detailedStats = readAndDetailMonth($selectedMonth, $selectedYear);
$globalViews = readVisits();
$monthlyViews = readAndCountByMonth($selectedMonth, $selectedYear);

?>

<h1 class="text-center m-5"><?= $title ?></h1>
<div class="container">
    <div class="row mb-5">
        <div class="col-sm-2">
            <?= yearDashboardButtons($currentYear, $selectedYear) ?>
        </div>

        <?php if (isset($_GET['annee'])) : ?>
            <div class="col-sm-2">
                <?= monthDashboardButtons(MONTHS, $selectedYear, $currentMonth, $currentYear, $selectedMonth) ?>
            </div>
        <?php endif; ?>

        <div class="col-sm-5">
            <p class="card p-4"><strong style="font-size: 2em;"><?= $globalViews ?> vue<?= $globalViews > 1 ? 's' : '' ?></strong><br>nombre total de visites</p>

            <?php if (isset($_GET['annee']) && isset($_GET['mois'])) : ?>
                <p class="card p-4"><strong><?= $monthlyViews ?> vue<?= $monthlyViews > 1 ? 's' : '' ?></strong><br>nombre de visites pour le mois de <?= MONTHS[$selectedMonth] . ' ' . $selectedYear ?></p>

                <?php if (!empty($detailedStats)) : ?>
                    <div class="card p-4">
                        <h2>Details des visites</h2>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">Jour</th>
                                    <th scope="col">Mois</th>
                                    <th scope="col">Année</th>
                                    <th scope="col">Nombre de visites</th>
                                </tr>
                            </thead>

                            <?php foreach ($detailedStats as $data) : ?>
                                <tr>
                                    <td><?= $data['jour'] ?></td>
                                    <td><?= MONTHS[$data['mois']] ?></td>
                                    <td><?= $data['année'] ?></td>
                                    <td><?= $data['vues'] ?> vue<?= $data['vues'] > 1 ? 's' : '' ?></td>
                                </tr>
                            <?php endforeach; ?>

                        </table>
                    </div>
                <?php endif; ?>

            <?php endif; ?>

        </div>
        <div class="col-sm-2">
            <a class="btn btn-outline-primary btn-block" href="/logout.php">Se deconnecter</a>
        </div>
    </div>
</div>

<?php
require 'elements' . DIRECTORY_SEPARATOR . 'footer.php';
?>