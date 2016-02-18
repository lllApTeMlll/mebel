<?php

class Menu extends CI_Controller {

    private $Component = "Menu";
    
    public function __construct() {
        parent::__construct();
        $this->load->model('user_model');
        $this->load->model('Seo_model');
        $this->load->model('list_model');
        $this->CurrentModel = $this->list_model;
        $this->user_model->isAvtoris();
    }

    public function index() {
        $dat['com'] = $this->user_model->getComp();
        $this->CurrentModel->setId(13);
        $this->CurrentModel->setmaxDee(3);
        $dat['cat'] = $this->CurrentModel->get_Items("manuList", 'nestable3', 1,3);
        $this->load->view('admin/base/header', $dat);
        $this->load->view('admin/'.$this->Component.'/List', $dat);
        $this->load->view('admin/base/footer');
    }
    
    public function addCat() {
        $mas = ($this->input->post(null, true));
        //echo "<pre>";
        //var_dump($mas);//die();
        $this->CurrentModel->saveCat($mas, array('Title','Link','id','Parent_id'));
        header("Location: /fasadm/{$this->Component}/");
    }

}
