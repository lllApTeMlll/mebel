<?php

class Menu extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('user_model');
        $this->load->model('Seo_model');
        $this->load->model('list_model');
        $this->user_model->isAvtoris();
    }

    public function index() {
        $dat['com'] = $this->user_model->getComp();
        $this->list_model->setId(13);
        $this->list_model->setmaxDee(2);
        $dat['cat'] = $this->list_model->get_Items("catList", 'nestable3', 1,1);
        $this->load->view('admin/base/header', $dat);
        $this->load->view('admin/Menu/List', $dat);
        $this->load->view('admin/base/footer');
    }
    
    public function addCat() {
        $mas = ($this->input->post(null, true));
        echo "<pre>";
        //var_dump($mas);//die();
        $this->list_model->saveCat($mas, array('Title','Link','id','Parent_id'));
        header("Location: /fasadm/Menu/");
    }

}
