<?php

/**
 * Application Front Controller
 */
require 'inc/kernel.php';

// ### Action Matching by URL
$uri = $_SERVER['REQUEST_URI'];
// Strip the query string from the URI
list($uri) = explode('?', $uri);
$action = substr($uri, strpos($uri, 'index.php') + strlen('index.php'));
// Route Collection
switch ($action) {
    case '/contact/list':
        ContactController::listAction();
        break;
    case '/contact/manage':
        ContactController::manageAction();
        break;
    case '/contact/group':
        ContactGroupController::manageAction();
        break;
    case '/group/manage':
        GroupController::manageAction();
        break;
    case '/group/connect':
        GroupController::connectAction();
        break;
    default:
        header('Location: ' . url_to('/contact/list'));
}
