<?php

class Main extends CI_Controller {

    private $menu = "";

    public function __construct() {
        parent::__construct();
        //$this->load->model('Catalog_model');
        $this->load->model('list_model');
        $this->load->model('Seo_model');
        $this->load->library('pagin');
        $List11 = $this->list_model->get_List(array("Parent_id" => 13, "count" => 100));
        $cat = $this->list_model->get_List(array("Parent_id" => 28, "count" => 100));
        $cat1 = $this->list_model->get_List(array("Parent_id" => 29, "count" => 100));
        $this->menu = $this->list_model->menuCat($List11, array(array("link" => "/catalog/catalog/", "list" => $cat, "id" => 14),
            array("link" => "/catalog/material/", "list" => $cat1, "id" => 22)), "", "");
    }

    public function index() {
        //echo "ok";die();
        $dat['menu'] = $this->menu;
        $this->load->view('site/base/headerMain', $dat);
        $this->load->view('site/main', $dat);
        $this->load->view('site/base/footerMain');
    }

}
