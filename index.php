<?php

require_once('controllers/posts_controller.php');
require_once('controllers/comments_controller.php');

function autoloading($class) {
 require 'model/' . $class . '.php';
}

spl_autoload_register('autoloading');