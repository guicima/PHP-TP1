<?php
$title = 'Dashboard';
require 'elements' . DIRECTORY_SEPARATOR . 'header.php';
?>
<h1 class="text-center"><?= $title ?></h1>
<div class="container">
    <div class="row">
        <?= buildDashboard(MONTHS, 2020) ?>
    </div>
</div>

<?php
require 'elements' . DIRECTORY_SEPARATOR . 'footer.php';
?>