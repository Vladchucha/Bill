<?php // index.php
 include 'config/checkErrors.php' ;
 include 'config/helpers.php' ;
//##########
session_start();  // Start the session at the very top of the file

// Include the necessary files
require_once 'app/Router.php';
require_once 'config/db.php';  // Database connection setup

// Include the controllers
require_once 'app/controllers/LoginController.php';
require_once 'app/controllers/RegisterController.php';
require_once 'app/controllers/LandingController.php';
require_once 'app/controllers/CarriersController.php';
require_once 'app/controllers/BillsController.php';  // Include BillsController


// Initialize the Router with the database connection
$db = dbmsql::getInstance();
$router = new Router($db);

// Get the requested URL
$url = $_SERVER['REQUEST_URI'];

// Dispatch the request to the appropriate controller/action
$router->dispatch($url);

