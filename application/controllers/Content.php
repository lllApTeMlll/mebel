<?php

class Content extends CI_Controller {

    public function __construct() {
        parent::__construct();
        //$this->load->model('Catalog_model');
        //$this->load->model('Load_model');
        $this->load->model('Seo_model');
        $this->load->library('pagin');
    }

    public function index() {
        //echo "ok";die();
        $dat['d'] = "";
        $this->load->view('site/base/header', $dat);
        $this->load->view('site/content/iner', $dat);
        $this->load->view('site/base/footer');
    }

}

