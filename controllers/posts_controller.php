<?php

function startSession() {
    if (!isset($_SESSION)) {
        session_start();
    }
}

function homePage() {
    startSession();
    require_once('view/actus_view.php');
}