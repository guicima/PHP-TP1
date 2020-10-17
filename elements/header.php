<?php
require dirname(__DIR__) . DIRECTORY_SEPARATOR . 'data' . DIRECTORY_SEPARATOR . 'config.php';
require dirname(__DIR__) . DIRECTORY_SEPARATOR . 'functions.php';

/*Avoid same user increasing number in one visit

if (empty($_COOKIE['visit'])) {
    countVisits();
    setcookie('visit', true);
}

*/

countVisits();


$menu = [
    'Home' => 'index.php',
    'Dashboard' => 'dashboard.php',
    'Dashboard - 2' => 'dashboard2.php',
    'About' => 'about.php',
    'Contact' => 'contact.php'
]
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $pagetitle ?></title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
</head>


<body>

    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="#">Navbar</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <?= createNavbar($menu, $title) ?>
                </div>
            </div>
        </nav>
    </header>