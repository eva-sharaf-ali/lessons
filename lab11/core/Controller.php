<?php
namespace Core;

class Controller {
    // Method to load views
    public function view($view, $data = []) {
        // Extract the data array into variables
        extract($data);
        // Require the appropriate view file
        require_once __DIR__ . "/../app/views/$view.php";
    }
}
