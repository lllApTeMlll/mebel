<?php

class Catalog extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('user_model');
        $this->load->model('Catalog_model');
        $this->load->model('Load_model');
        $this->load->model('Seo_model');
        $this->load->model('list_model');
        $this->load->library('pagin');
        $this->load->helper('text');
        $this->load->library('session');
        $this->user_model->isAvtoris();
    }

    public function index() {
        $dat['com'] = $this->user_model->getComp();
        $page = $this->input->get('page', true);
        $config['total_rows'] = $this->Catalog_model->get_count();
        $config['base_url'] = "";
        $config['cur_page'] = $page;
        $config['page_size'] = 12;
        $this->pagin->initialize($config);
        $dat['pagin'] = $this->pagin->getLinksAdmin();
        $dat['catalog'] = $this->Catalog_model->get_Catalog(array("current" => $page, "count" => $config['page_size']));
        $this->list_model->setId(1);
        $this->list_model->setmaxDee(3);
        $dat['cat'] = $this->list_model->get_Items("catList", 'nestable3', 1,3);
        $this->load->view('admin/base/header', $dat);
        $this->load->view('admin/Catalog/List', $dat);
        $this->load->view('admin/base/footer');
    }

    public function addItem() {
        $isAdd = $this->input->post('Title', true);
        if ($isAdd) {
            $this->updateAndInsert();
            header("Location: /fasadm/Catalog/");
        } else {
            $this->Load_model->delWithout();
            $dat['com'] = $this->user_model->getComp();
            $dat['current']['mas'] = array("Title" => "", "Articl" => "", "Price" => "", "Description" => "", "Sostav" => "", "EnglishTitle" => "");
            $dat['current']['type'] = "add";
            $dat['current']['id'] = "";
            $dat['current']['image'] = "";
            $this->load->view('admin/base/header', $dat);
            $this->load->view('admin/Catalog/Edit', $dat);
            $this->load->view('admin/base/footer');
        }
    }
    
    public function addCat() {
        $mas = ($this->input->post(null, true));
        echo "<pre>";
        //var_dump($mas);//die();
        $this->list_model->saveCat($mas, array('Title','Link','id','Parent_id'));
        header("Location: /fasadm/Catalog/");
    }

    public function editItem($id) {
        //var_dump(phpinfo());die();
        $isAdd = $this->input->post('Title', true);
        if ($isAdd) {
            $this->updateAndInsert();
            header("Location: /fasadm/Catalog/");
        } else {
            $this->Load_model->delWithout();
            $dat['com'] = $this->user_model->getComp();
            $dat['current']['mas'] = $this->Catalog_model->get_Catalog(array("count" => 1, "id" => $id));
            $dat['current']['type'] = "edit";
            $dat['current']['id'] = $id;
            $dat['current']['image'] = $this->Load_model->getPhotos(array("Type" => "item", "Item_id" => $id, "count" => 100));
            $this->load->view('admin/base/header', $dat);
            $this->load->view('admin/Catalog/Edit', $dat);
            $this->load->view('admin/base/footer');
        }
    }

    public function delitItem($id) {
        $this->Catalog_model->delete($id);
        header("Location: /fasadm/Catalog/");
    }

    public function updateAndInsert() {
        $mas = ($this->input->post(null, true));
       // echo "<pre>";
        //var_dump($mas);die();
        $id = $this->input->post('id', true);
        $type = $this->input->post('type', true);
        if ($type == 'add') {
            $id = $this->Catalog_model->insert($mas);
        } else {
            $this->Catalog_model->update($mas, $id);
        }
        if (isset($mas["del"])) {
            foreach ($mas["del"] as $v) {
                $this->Load_model->delete($v);
            }
        }
        $edit["Type"] = "item";
        foreach ($mas["id_photo"] as $k => $v) {
            $edit["Item_id"] = $id;
            $edit["Order"] = $k;
            $this->Load_model->update($edit, $v);
        }
        $mas["Url"] = "/Catalog/item/" . $id ."/";
        $mas["Psevdonime"] = "/Catalog/item/" . $mas["EnglishTitle"]."/";
        $this->Seo_model->insert($mas);
        //var_dump($id);die();
    }

}
