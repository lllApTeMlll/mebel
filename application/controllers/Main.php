<?php

class Main extends CI_Controller {

    private $menu = "";

    public function __construct() {
        parent::__construct();
        $this->load->model('Base_model');
        $this->Base_model->set_table("Text");
        $this->vstavka = $this->Base_model->get_ListV();
        $this->load->model('list_model');
        $this->load->model('Seo_model');
        $this->load->model('Load_model');
        $this->load->model('Content_model');
        $this->load->helper('text');
        $this->load->library('pagin');
        $List11 = $this->list_model->get_List(array("Parent_id" => 13, "count" => 100));
        $cat = $this->list_model->get_List(array("Parent_id" => 28, "count" => 100));
        $cat1 = $this->list_model->get_List(array("Parent_id" => 29, "count" => 100));
        $this->menu = $this->list_model->menuCat($List11, array(array("link" => "/catalog/catalog/", "list" => $cat, "id" => 14),
            array("link" => "/catalog/material/", "list" => $cat1, "id" => 22)), "", "");
    }

    public function index() {
        $dat['seo'] = $this->Seo_model->getSeo($_SERVER['REQUEST_URI']);
        //var_dump($_SERVER['REQUEST_URI']);die();
        $dat['menu'] = $this->menu;
        $dat['vstavka'] = $this->vstavka;
        $this->Base_model->set_table("MainBlock");
        $dat["block"] = $this->Base_model->get_List(array());
        $dat["block"] = $this->madeTrueArray($dat["block"]);
        $this->Base_model->set_table("Slider");
        $dat["slider"] = $this->Base_model->get_List(array());
        $dat["slider"] = $this->madeTrueArray($dat["slider"],"slider");
        $dat["contact"] = $this->Content_model->get_List(array("count" => 1, "Url" => "/contacts/"));
        $this->load->view('site/base/headerMain', $dat);
        $this->load->view('site/main', $dat);
    }
    
    private function madeTrueArray($mas, $type = "main", $array = false) {
        foreach ($mas as $k => $v) {
            $pthoto = $this->Load_model->get_List(array('count' => ($array ? 100 : 1), "Type" => $type, "Item_id" => $v['id']));
            if ($pthoto) {
                $mas[$k]['photo'] = ($array ? $pthoto : $pthoto['Puth'] . "small/" . $pthoto['Name']);
            } else {
                $mas[$k]['photo'] = "";
            }
        }
        return $mas;
    }

}
