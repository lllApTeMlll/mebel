<?php

class MainBlock extends CI_Controller {

    private $Component = "MainBlock";

    public function __construct() {
        parent::__construct();
        $this->load->model('user_model');
        $this->load->model('Base_model');
        $this->load->model('Load_model');
        $this->load->library('pagin');
        $this->load->helper('text');
        $this->CurrentModel = $this->Base_model;
        $this->CurrentModel->set_table("MainBlock");
        $this->CurrentModel->set_white(array("Title", "Description","Url"));
        $this->user_model->isAvtoris();
        $this->ajax = $this->input->post('type', true) === "ajax" ? true : false;
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
            $this->Load_model->delWithout();
            $dat['com'] = $this->user_model->getComp();
            $dat['current']['mas'] = array("Title" => "", "Description" => "", "Url" => "");
            $dat['current']['type'] = "add";
            $dat['current']['id'] = "";
            $dat['current']['image'] = "";
            $dat['current']['action'] = "/fasadm/{$this->Component}/add/";
            $this->load->view('admin/base/header', $dat);
            $this->load->view('admin/' . $this->Component . '/Edit', $dat);
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
            $this->Load_model->delWithout();
            $dat['com'] = $this->user_model->getComp();
            $dat['current']['mas'] = $this->CurrentModel->get_List(array("count" => 1, "id" => $id));
            $dat['current']['type'] = "edit";
            $dat['current']['id'] = $id;
            $dat['current']['action'] = "/fasadm/{$this->Component}/edit/{$id}/";
            $dat['current']['image'] = $this->Load_model->getPhotos(array("Type" => "main", "Item_id" => $id, "count" => 100));
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
        $edit["Type"] = "main";
        if (isset($mas["id_photo"])) {
            foreach ($mas["id_photo"] as $k => $v) {
                $edit["Item_id"] = $id;
                $edit["Order"] = $k;
                $this->Load_model->update($edit, $v);
                $edit["Type"] = "";
            }
        }
        if ($this->ajax)
            echo "ok";
    }

}
