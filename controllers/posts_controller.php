<?php

function startSession() {
    if (!isset($_SESSION)) {
        session_start();
    }
}

function homePage() {
    startSession();
    require_once('view/news_view.php');
}

function weLovedPage() {
    startSession();
    require_once('view/weLoved_view.php');
}

function tvShowsPage() {
    startSession();
    require_once('view/tvShows_view.php');
}

function mySpacePage() {
    startSession();
    require_once('view/mySpace_view.php');
}

function connexionPage() {
    startSession();
    require_once('view/connexion_view.php');
}

function contactPage() {
    startSession();
    require_once('view/contact_view.php');
}