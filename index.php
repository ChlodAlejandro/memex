<?php
namespace Memex;

use Memex\Route\Router;

// Boostrap
require __DIR__ . "/internal/bootstrap.php";

// Route the current request
Router::routeRequest();