<?php

function addNewUser ($pseudo, $pass, $email) {
    $pass = password_hash($pass, PASSWORD_DEFAULT);

    $usersManager = new UsersManager();

    $usersManager->addUser($pseudo, $pass, $email);
}
