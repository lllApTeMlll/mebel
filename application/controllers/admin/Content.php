<?php

class Content extends CI_Controller {

    private $Component = "Content";
    
    public function __construct() {
        parent::__construct();
        $this->load->model('user_model');
        $this->load->model('Content_model');
        $this->load->model('Seo_model');
        $this->load->library('pagin');
        $this->CurrentModel = $this->Content_model;
        $this->user_model->isAvtoris();
        $this->ajax = $this->input->post('type', true) === "ajax"  ? true : false;
    }

    public function index() {
        $dat['com'] = $this->user_model->getComp();
        $page = $this->input->get('page', true);
        $config['total_rows'] = $this->CurrentModel->get_count();
        $config['base_url'] = "";
        $config['cur_page'] = $page;
        $config['page_size'] = 12;
        $this->pagin->initialize($config);
        $dat['pagin'] = $this->pagin->getLinksAdmin();
        $dat['content'] = $this->CurrentModel->get_List(array("current" => $page, "count" => $config['page_size']));
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
            $dat['Seo'] = array("SeoDescription" => "", "SeoTitle" => "", "SeoKeyword" => "");
            $dat['current']['mas'] = array("Title" => "", "Puth" => "", "Description" => "");
            $dat['current']['type'] = "add";
            $dat['current']['id'] = "";
            $dat['current']['action'] = "/fasadm/{$this->Component}/add/";
            $this->load->view('admin/base/header', $dat);
            $this->load->view('admin/'.$this->Component.'/Edit', $dat);
            $this->load->view('admin/base/footer');
        }
    }

    public function editItem($id) {
        //var_dump(phpinfo());die();
        $isAdd = $this->input->post('Title', true);
        if ($isAdd) {
            $this->updateAndInsert();
            if (!$this->ajax) {
                header("Location: /fasadm/{$this->Component}/");
            }
        } else {
            $dat['com'] = $this->user_model->getComp();
            $dat['Seo'] = $this->Seo_model->get_List(array("count" => 1, "Url" => "/{$this->Component}/item/" . $id . "/"));
            $dat['current']['mas'] = $this->CurrentModel->get_List(array("count" => 1, "id" => $id));
            $dat['current']['type'] = "edit";
            $dat['current']['id'] = $id;
            $dat['current']['action'] = "/fasadm/{$this->Component}/edit/{$id}/";
            $this->load->view('admin/base/header', $dat);
            $this->load->view('admin/'.$this->Component.'/Edit', $dat);
            $this->load->view('admin/base/footer');
        }
    }

    public function delitItem($id) {
        $this->Content_model->delete($id);
        header("Location: /fasadm/{$this->Component}/");
    }

    public function updateAndInsert() {
        $mas = ($this->input->post(null, false));
        //echo "<pre>";
        //var_dump($mas);die();
        $id = $this->input->post('id', true);
        $type = $this->input->post('type', true);
        if ($type == 'add') {
            $id = $this->CurrentModel->insert($mas);
        } else {
            $this->CurrentModel->update($mas, $id);
        }
        $mas["Url"] = "/{$this->Component}/item/" . $id ."/";
        $mas["Psevdonime"] = $mas["Puth"];
        $this->Seo_model->insert($mas);
        if ($this->ajax) echo "ok";
        //var_dump($id);die();
    }

}
