<?php

class Project extends CI_Controller {

    private $Component = "Project";
    
    public function __construct() {
        parent::__construct();
        $this->load->model('user_model');
        $this->load->model('Project_model');
        $this->load->model('Seo_model');
        $this->load->library('pagin');
        $this->user_model->isAvtoris();
    }

    public function index() {
        $dat['com'] = $this->user_model->getComp();
        $page = $this->input->get('page', true);
        $config['total_rows'] = $this->Project_model->get_count();
        $config['base_url'] = "";
        $config['cur_page'] = $page;
        $config['page_size'] = 12;
        $this->pagin->initialize($config);
        $dat['pagin'] = $this->pagin->getLinksAdmin();
        $dat['content'] = $this->Project_model->get_list(array("current" => $page, "count" => $config['page_size']));
        $this->load->view('admin/base/header', $dat);
        $this->load->view('admin/'.$this->Component.'/List', $dat);
        $this->load->view('admin/base/footer');
    }

    public function addItem() {
        $isAdd = $this->input->post('Title', true);
        if ($isAdd) {
            $this->updateAndInsert();
            header("Location: /fasadm/{$this->Component}/");
        } else {
            $dat['com'] = $this->user_model->getComp();
            $dat['current']['mas'] = array("Title" => "", "Articl" => "", "Price" => "", "Description" => "", "Sostav" => "", "EnglishTitle" => "");
            $dat['current']['type'] = "add";
            $dat['current']['id'] = "";
            $this->load->view('admin/base/header', $dat);
            $this->load->view('admin/'.$this->Component.'/Edit', $dat);
            $this->load->view('admin/base/footer');
        }
    }
    
    public function addCat() {
        $mas = ($this->input->post(null, true));
        echo "<pre>";
        //var_dump($mas);//die();
        $this->list_model->saveCat($mas, array('Title','Link','id','Parent_id'));
        header("Location: /fasadm/{$this->Component}/");
    }

    public function editItem($id) {
        //var_dump(phpinfo());die();
        $isAdd = $this->input->post('Title', true);
        if ($isAdd) {
            $this->updateAndInsert();
            header("Location: /fasadm/{$this->Component}/");
        } else {
            $dat['com'] = $this->user_model->getComp();
            $dat['current']['mas'] = $this->Project_model->get_Catalog(array("count" => 1, "id" => $id));
            $dat['current']['type'] = "edit";
            $dat['current']['id'] = $id;
            $this->load->view('admin/base/header', $dat);
            $this->load->view('admin/'.$this->Component.'/Edit', $dat);
            $this->load->view('admin/base/footer');
        }
    }

    public function delitItem($id) {
        $this->Project_model->delete($id);
        header("Location: /fasadm/{$this->Component}/");
    }

    public function updateAndInsert() {
        $mas = ($this->input->post(null, true));
        echo "<pre>";
        //var_dump($mas);die();
        $id = $this->input->post('id', true);
        $type = $this->input->post('type', true);
        if ($type == 'add') {
            $id = $this->Project_model->insert($mas);
        } else {
            $this->Project_model->update($mas, $id);
        }
        $mas["Url"] = "/{$this->Component}/" . $id ."/";
        $mas["Psevdonime"] = $mas["Puth"];
        $this->Seo_model->insert($mas);
        //var_dump($id);die();
    }

}
