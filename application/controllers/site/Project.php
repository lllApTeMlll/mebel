<?php

class Project extends CI_Controller {

    private $Component = "project";
    
    public function __construct() {
        parent::__construct();
        $this->load->model('Project_model');
        $this->load->model('list_model');
        $this->load->model('Load_model');
        $this->load->model('Seo_model');
        $this->load->library('pagin');
        $this->load->helper('text');
        $this->CurrentModel = $this->Project_model;
        $List11 = $this->list_model->get_List(array("Parent_id" => 13, "count" => 100));
        $cat = $this->list_model->get_List(array("Parent_id" => 1, "count" => 100));
        $this->menu = $this->list_model->menuCat($List11, array(array("link" => "/catalog/", "list" => $cat, "id" => 14)), "", "");
    }

    public function index() {
        $dat['menu'] = $this->menu;
        $page = $this->input->get('page', true);
        $config['total_rows'] = $this->CurrentModel->get_count();
        $config['base_url'] = "";
        $config['cur_page'] = $page;
        $config['page_size'] = 16;
        $this->pagin->initialize($config);
        $dat['pagin'] = $this->pagin->getLinks();
        $catalogList = $this->CurrentModel->get_List(array("current" => $page, "count" => $config['page_size']));
        $dat["catList"] = $this->madeTrueArray($catalogList,true);
        //var_dump($dat["catList"]);
        $this->load->view('site/base/header', $dat);
        $this->load->view('site/' . $this->Component . '/list', $dat);
        $this->load->view('site/' . $this->Component . '/catalog', $dat);
        $this->load->view('site/' . $this->Component . '/listEnd', $dat);
        $this->load->view('site/base/footer');
    }
    
    public function item() {
        $dat['d'] = "";
        $this->load->view('site/base/header', $dat);
        $this->load->view('site/project/item', $dat);
        $this->load->view('site/base/footer');
    }
    
    private function madeTrueArray($mas, $array = false) {
        foreach ($mas as $k => $v) {
            $pthoto = $this->Load_model->get_List(array('count' => ($array ? 100 : 1), "Type" => "project", "Item_id" => $v['id']));
            if ($pthoto) {
                $mas[$k]['photo'] = ($array ? $pthoto : $pthoto['Puth'] . "small/" . $pthoto['Name']);
            } else {
                $mas[$k]['photo'] = "";
            }
        }
        return $mas;
    }

}

