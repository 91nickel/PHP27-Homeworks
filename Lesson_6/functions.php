<?php
session_start();
function isAuthorized($user = false)
{
    if (isset($_SESSION['user'])) {
        if ($user === false or $_SESSION['user'] === $user) {
            return true;
        }
    }
    return false;
}

function isAdmin()
{
    if (isset($_SESSION['user'])) {
        if ($_SESSION['user'] === 'ADMINISTRATOR') {
            return true;
        } else {
            return false;
        }
    }
    return false;
}

function isGuest()
{
    if (isset($_SESSION['user'])) {
        if ($_SESSION['user'] === 'GUEST') {
            return true;
        } else {
            return false;
        }
    }
    return false;
}

function showError403()
{
    http_response_code(403);
    exit('<h1>403 Forbidden</h1><p>Перейти к <a href="mainBoard.php">форме авторизации</a></p>');
}