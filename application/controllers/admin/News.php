<?php

class News extends CI_Controller {

    private $Component = "News";
    
    public function __construct() {
        parent::__construct();
        $this->load->model('user_model');
        $this->load->model('News_model');
        $this->load->model('Seo_model');
        $this->load->library('pagin');
        $this->load->model('Load_model');
        $this->load->model('list_model');
        $this->load->model('Base_model');
        $this->load->helper('text');
        $this->CurrentModel = $this->News_model;
        $this->user_model->isAvtoris();
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
        $this->list_model->setId(19);
        $this->list_model->setmaxDee(2);
        $dat['cat'] = $this->list_model->get_Items("catList", 'nestable3', 1, 1);
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
            
            $dat['current']['mas'] = array("Title" => "", "Date" => "", "Type" => "", "Description" => "", "EnglishTitle" => "");
            $dat['current']['type'] = "add";
            $dat['current']['image'] = "";
            $dat['current']['id'] = "";
            $dat['current']['cat'] = $this->Base_model->getOtion(19, "", -1, "");
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
            header("Location: /fasadm/{$this->Component}/");
        } else {
            $dat['com'] = $this->user_model->getComp();
            $dat['Seo'] = $this->Seo_model->get_List(array("count" => 1, "Url" => "/{$this->Component}/item/" . $id . "/"));
            $dat['current']['mas'] = $this->CurrentModel->get_List(array("count" => 1, "id" => $id));
            $dat['current']['type'] = "edit";
            $dat['current']['image'] = $this->Load_model->getPhotos(array("Type" => "news", "Item_id" => $id, "count" => 100));
            $dat['current']['id'] = $id;
            $dat['current']['cat'] = $this->Base_model->getOtion(19, "", $dat['current']['mas']['Type'], "");
            $this->load->view('admin/base/header', $dat);
            $this->load->view('admin/'.$this->Component.'/Edit', $dat);
            $this->load->view('admin/base/footer');
        }
    }

    public function addCat() {
        $mas = ($this->input->post(null, true));
        //echo "<pre>";
        //var_dump($mas);//die();
        $this->list_model->saveCat($mas, array('Title','Link','id','Parent_id'));
        header("Location: /fasadm/{$this->Component}/");
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
        $edit["Type"] = "news";
        if (isset($mas["id_photo"])) {
            foreach ($mas["id_photo"] as $k => $v) {
                $edit["Item_id"] = $id;
                $edit["Order"] = $k;
                $this->Load_model->update($edit, $v);
                $edit["Type"] = "";
            }
        }
        $mas["Url"] = "/{$this->Component}/item/" . $id . "/";
        $mas["Psevdonime"] = "/News/item/" . $mas["EnglishTitle"] . "/";
        $this->Seo_model->insert($mas);
    }

}
