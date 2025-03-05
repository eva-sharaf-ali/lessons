<?php
namespace App\Controllers;

use Core\Controller;
class NotFound extends Controller{

    public  function index(){
        $this->view("404",['hint'=>"Not found Page"]);
    }
    public function welcome(){
        $this->view("hello",['we'=>"welcome sava"]);
    }
}