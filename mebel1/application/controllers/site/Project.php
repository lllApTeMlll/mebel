<?php

class Project extends CI_Controller {

    public function __construct() {
        parent::__construct();
        //$this->load->model('Catalog_model');
        //$this->load->model('Load_model');
        $this->load->model('Seo_model');
        $this->load->library('pagin');
    }

    public function index() {
        $dat['d'] = "";
        $this->load->view('site/base/header', $dat);
        $this->load->view('site/project/list', $dat);
        $this->load->view('site/base/footer');
    }
    
    public function item() {
        $dat['d'] = "";
        $this->load->view('site/base/header', $dat);
        $this->load->view('site/project/item', $dat);
        $this->load->view('site/base/footer');
    }
    
    

}

