<?php
define("PATH", dirname($_SERVER['SCRIPT_NAME']));
require_once __DIR__ . '/core/Autoloader.php';
require_once __DIR__ . '/core/Database.php';
require_once __DIR__ . '/routes/web.php';

use Core\Database;

// Initialize Database and Users Table
Database::connect();

// http://localhost/Lessons/lab11/users