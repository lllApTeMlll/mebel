<?php

class Catalog extends CI_Controller {

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
        $this->load->view('site/catalog/list', $dat);
        $this->load->view('site/base/footer');
    }

    public function item($id) {
        $dat['d'] = "";
        $this->load->view('site/base/header', $dat);
        $this->load->view('site/catalog/item', $dat);
        $this->load->view('site/base/footer');
    }

}
