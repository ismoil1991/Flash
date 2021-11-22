<?php
session_start();
include 'functions.php';

$email = $_POST['email'];
$password = $_POST['password'];

$user = login($email, $password);

if ($user) {
    set_flash_message('success', 'OK');

    header('Location: /users.php');
    exit;
} else {
    set_flash_message('danger', 'Неправильный пароль или email');

    header('Location: /page_login.php');
    exit;
}