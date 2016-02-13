<?php

class Content extends CI_Controller {

    private $menu = "";
    
    public function __construct() {
        parent::__construct();
        $this->load->model('Content_model');
        //$this->load->model('Load_model');
        $this->load->model('list_model');
        $this->load->model('Seo_model');
        $this->load->library('pagin');
        $List11 = $this->list_model->get_List(array("Parent_id" => 13, "count" => 100));
        $cat = $this->list_model->get_List(array("Parent_id" => 1, "count" => 100));
        $this->menu = $this->list_model->menuCat($List11, array(array("link" => "/catalog/", "list" => $cat, "id" => 14)), "", "");
    }

    public function index() {
        echo "ok";die();
        $dat['menu'] = $this->menu;
        $dat['content'] = $this->Content_model->get_List(array("count"=>1,"Url"=>$_SERVER['REQUEST_URI']));
        if (!$dat['content']){
            show_404();
            die();
        }
        //var_dump($dat['content']);die();
        $this->load->view('site/base/header', $dat);
        $this->load->view('site/content/iner', $dat);
        $this->load->view('site/base/footer');
    }

}
