<?php

function displayErrorMsg($error) {
    $errorMsg = '';

    switch($error) {

        case '400':
            $errorMsg = 'Echec de l\'analyse HTTP.';
            break;

        case '401':
            $errorMsg = 'Pseudo ou mot de passe incorrect.';
            break;

        case '403':
            $errorMsg = 'Requête interdite.';
            break;

        case '404':
            $errorMsg = 'Cette page n\'existe pas.';
            break;

        case '500':
            $errorMsg = 'Erreur interne au serveur ou serveur saturé.';
            break;

        case '503':
            $errorMsg = 'Service indisponible.';
            break;

        case '504':
            $errorMsg = 'Le serveur a mis trop de temps à répondre.';
            break;

        default:
            $errorMsg = 'Oops, une erreur est survenue.';
    }

    require_once('view/error.php');
}