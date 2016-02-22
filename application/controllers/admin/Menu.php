<?php

class Menu extends CI_Controller {

    private $Component = "Menu";

    public function __construct() {
        parent::__construct();
        $this->load->model('user_model');
        $this->load->model('Seo_model');
        $this->load->model('list_model');
        $this->load->model('Content_model');
        $this->CurrentModel = $this->list_model;
        $this->user_model->isAvtoris();
        $this->ajax = $this->input->post('type', true) === "ajax" ? true : false;
    }

    public function index() {
        $dat['com'] = $this->user_model->getComp();
        $this->CurrentModel->setId(13);
        $this->CurrentModel->setmaxDee(4);
        $dat['cat'] = $this->CurrentModel->get_Items("manuList", 'nestable3', 1);
        $this->load->view('admin/base/header', $dat);
        $this->load->view('admin/' . $this->Component . '/List', $dat);
        $this->load->view('admin/base/footer');
    }

    public function addCat() {
        //echo "<pre>";
        $mas = ($this->input->post(null, true));
        $this->CurrentModel->saveCat($mas, array('Title', 'Link', 'id', 'Parent_id','Create'));
         //var_dump($mas);
        foreach ($mas['Create'] as $k => $v) {
            if ($v === "checked"){
                $isIsetPAge = $this->Content_model->get_List(array("count" => 1, "Url" => $mas['Link'][$k]));
                if (!$isIsetPAge){
                    $id = $this->Content_model->insert(array("Title" => $mas['Title'][$k], "Puth" => $mas['Link'][$k],"Cat"=>"iner"));    
                    //var_dump($id);
                }
            }      
        }
        //die();
        if (!$this->ajax) {
            header("Location: /fasadm/{$this->Component}/");
        }
        if ($this->ajax) echo "ok";
    }

}
