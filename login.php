<?php
$title = 'Login';
session_start();
$email = $_POST['email'];
$password = $_POST['password'];
$connectionError = null;
require_once 'data' . DIRECTORY_SEPARATOR . 'config.php';
require_once 'functions.php';

if (!empty($_POST)) {
    if (connection($email, $password) === 0) {
        $_SESSION['role'] = 'admin';
        header('Location: /dashboard.php');
    } elseif (connection($email, $password) === 1) {
        $connectionError = 'Mot de passe incorrect';
    } elseif (connection($email, $password) === 2) {
        $connectionError = 'E-mail incorrect';
    }
}

require 'elements' . DIRECTORY_SEPARATOR . 'header.php';

?>

<div class="d-flex justify-content-center">
    <div class="card p-5 m-5 w-30">
        <form action="" method="POST">
            <div class="form-group">
                <label for="email">Adresse e-mail :</label>
                <input class="form-control" type="email" name="email" id="email">
            </div>
            <div class="form-group">
                <label for="password">Mot de passe :</label>
                <input class="form-control" type="password" name="password" id="password">

                <?php if ($connectionError != null) : ?>
                    <div class="alert alert-danger mt-2"><?= $connectionError ?></div>
                <?php endif ?>

            </div>
            <button type="submit" class="btn btn-primary">Se connecter</button>
        </form>
    </div>
</div>

<?php
require 'elements' . DIRECTORY_SEPARATOR . 'footer.php';
?>