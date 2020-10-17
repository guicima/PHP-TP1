<?php
$title = 'Dashboard - 2';
require 'elements' . DIRECTORY_SEPARATOR . 'header.php';
$currentYear = date("Y");
$currentMonth = date("m");
$selectedYear = isset($_GET['annee']) ? (int)$_GET['annee'] : $currentYear;
$selectedMonth = isset($_GET['mois']) ? $_GET['mois'] : '0';
?>
<h1 class="text-center"><?= $title ?></h1>
<div class="container">
    <div class="row">
        <div class="col-sm-2">
            <?= yearDashboardButtons($currentYear, $selectedYear) ?>
        </div>
        <?php if (isset($_GET['annee'])) : ?>
            <div class="col-sm-2">
                <?= monthDashboardButtons(MONTHS, $selectedYear, $currentMonth, $currentYear, $selectedMonth) ?>
            </div>
        <?php endif; ?>
        <div class="col-sm-6">
            <p><strong><?= readVisits() ?></strong><br>nombre total de visites</p>
            <?php if (isset($_GET['annee']) && isset($_GET['mois'])) : ?>
                <p><strong><?= readAndCountByMonth($selectedMonth, $selectedYear) ?></strong><br>nombre de visites pour le mois de <?= MONTHS[$selectedMonth] . ' ' . $selectedYear ?></p>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php
require 'elements' . DIRECTORY_SEPARATOR . 'footer.php';
?>