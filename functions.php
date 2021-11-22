<?php
session_start();

function set_flash_message($name, $message)
{
    $_SESSION[$name] = $message;
}

/**
 * Parametrs:
 * string - $name (ключ)
 *
 * Description: вывести флеш сообщение
 *
 * Return value: null
 **/
function display_flash_message($name)
{
    if ($_SESSION[$name]) {
        echo '<div class="alert alert-' . $name . ' text-dark" role="alert">' . $_SESSION[$name] . '</div>';
        unset($_SESSION[$name]);
    }
}

/**
 * Parametrs:
 * string - $email
 * string - $password
 *
 * Description: авторизовать пользователя
 *
 * Return value: boolean
 */
function login($email, $password)
{
    $pdo = new PDO("mysql:host=localhost;dbname=diving", "root", "root");
    $sql = 'SELECT * FROM users WHERE email =:email';
    $statement = $pdo->prepare($sql);
    $statement->execute(['email' => $email]);
    $user = $statement->fetch(2);

    if ($user) {
        $password = password_verify($password, $user['password']);
        if ($password)
            $_SESSION['user'] = $user;
        return true;
    } else {
        return false;
    }
}

?>