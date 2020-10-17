<?php

function isConnected(): bool
{
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    return !empty($_SESSION['role']);
}

function forceConnection(): void
{
    if (!isConnected()) {
        header('Location: /login.php');
        exit();
    }
}
