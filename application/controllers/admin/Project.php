<?php

class Project extends CI_Controller {

    private $Component = "Project";

    public function __construct() {
        parent::__construct();
        $this->load->model('user_model');
        $this->load->model('Project_model');
        $this->load->model('Seo_model');
        $this->load->library('pagin');
        $this->load->model('Load_model');
        $this->load->helper('text');
        $this->CurrentModel = $this->Project_model;
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
        $this->load->view('admin/' . $this->Component . '/List', $dat);
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
            $dat['current']['mas'] = array("Title" => "", "Review" => "", "Description" => "", "EnglishTitle" => "");
            $dat['current']['type'] = "add";
            $dat['current']['image'] = "";
            $dat['current']['id'] = "";
            $dat['current']['action'] = "/fasadm/{$this->Component}/add/";
            $this->load->view('admin/base/header', $dat);
            $this->load->view('admin/' . $this->Component . '/Edit', $dat);
            $this->load->view('admin/base/footer');
        }
    }

    public function addCat() {
        $mas = ($this->input->post(null, true));
        echo "<pre>";
        //var_dump($mas);//die();
        $this->list_model->saveCat($mas, array('Title', 'Link', 'id', 'Parent_id'));
        header("Location: /fasadm/{$this->Component}/");
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
            $dat['current']['image'] = $this->Load_model->getPhotos(array("Type" => "project", "Item_id" => $id, "count" => 100));
            $this->load->view('admin/base/header', $dat);
            $this->load->view('admin/' . $this->Component . '/Edit', $dat);
            $this->load->view('admin/base/footer');
        }
    }

    public function delitItem($id) {
        $this->CurrentModel->delete($id);
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
        if (isset($mas["del"])) {
            foreach ($mas["del"] as $v) {
                $this->Load_model->delete($v);
            }
        }
        $edit["Type"] = "project";
        if (isset($mas["id_photo"])) {
            foreach ($mas["id_photo"] as $k => $v) {
                $edit["Item_id"] = $id;
                $edit["Order"] = $k;
                $this->Load_model->update($edit, $v);
            }
        }
        $mas["Url"] = "/{$this->Component}/item/" . $id . "/";
        $mas["Psevdonime"] = "/Catalog/item/" . $mas["EnglishTitle"] . "/";
        $this->Seo_model->insert($mas);
        if ($this->ajax) echo "ok";
    }

}
