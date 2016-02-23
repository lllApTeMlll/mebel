<?php

class Form extends CI_Controller {

    private $menu = "";
    private $cat = "";
    private $Component = "catalog";

    public function __construct() {
        parent::__construct();
    }

    public function index(){
         echo "okIndex";
    }
    
    public function sendEmail() {
        echo "ok";
    }



}
