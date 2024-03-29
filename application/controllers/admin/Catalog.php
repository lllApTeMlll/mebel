<?php

class Catalog extends CI_Controller {

    private $Component = "Catalog";

    public function __construct() {
        parent::__construct();
        $this->load->model('user_model');
        $this->user_model->isAvtoris();
        $this->load->model('Catalog_model');
        $this->load->model('Base_model');
        $this->load->model('Load_model');
        $this->load->model('Seo_model');
        $this->load->model('list_model');
        $this->load->library('pagin');
        $this->load->helper('text');
        $this->load->library('session');
        $this->CurrentModel = $this->Catalog_model;
        $this->ajax = $this->input->post('type', true) === "ajax" ? true : false;
    }

    public function index() {
        //var_dump($this->ajax);die();
        if (!$this->ajax) {
            $dat['com'] = $this->user_model->getComp();
        }
        $page = $this->input->get('page', true);
        $cat = $this->input->get('cat', true);
        $cat = $cat ? $cat : false;
        $config['total_rows'] = $this->CurrentModel->get_count(array("cid" => array($cat, false, false)));
        $config['base_url'] = "";
        $config['cur_page'] = $page;
        $config['page_size'] = 30;
        $this->pagin->initialize($config);
        $dat['pagin'] = $this->pagin->getLinksAdmin();
        $dat['content'] = $this->CurrentModel->get_List(array("current" => $page, "count" => $config['page_size'], "cid" => array($cat, false, false)));
        $dat['content'] = $this->Base_model->getRightName($dat['content']);
        if (!$this->ajax) {
            $this->list_model->setId(1);
            $this->list_model->setmaxDee(4);
            $dat['current']['cat'] = $this->Base_model->getOtion(1, "<option value='-'>-</option>", $cat, "");
            $dat['cat'] = $this->list_model->get_Items("catList", 'nestable3', 1);
            $this->load->view('admin/base/header', $dat);
            $this->load->view('admin/' . $this->Component . '/List', $dat);
        }
        $this->load->view('admin/' . $this->Component . '/ListAjax', $dat);
        if (!$this->ajax) {
            $this->load->view('admin/' . $this->Component . '/ListEnd', $dat);
            $this->load->view('admin/base/footer');
        }
    }

    public function addItem() {
        $isAdd = $this->input->post('Title', true);
        if ($isAdd) {
            $this->updateAndInsert();
            //header("Location: /fasadm/{$this->Component}/");
        } else {
            $this->Load_model->delWithout();
            $dat['com'] = $this->user_model->getComp();
            $dat['Seo'] = array("SeoDescription" => "", "SeoTitle" => "", "SeoKeyword" => "");
            $dat['current']['mas'] = array("Title" => "", "Articl" => "", "Price" => "", "Description" => "", "Sostav" => "", "EnglishTitle" => "", "PriceText" => "", "SostavStandart" => "СОСТАВ СТАНДАРТНОЙ КОМПЛЕКТАЦИИ");
            $dat['current']['type'] = "add";
            $dat['current']['id'] = "";
            $dat['current']['image'] = "";
            $dat['current']['itemFasad'] = "";
            $dat['current']['itemColor'] = "";
            $dat['current']['rigthPhoto'] = "";
            $dat['current']['action'] = "/fasadm/{$this->Component}/add/";
            //$cat = $this->list_model->get_ItemsEl(array("Parent_id" => 1, "count" => 100));
            $dat['current']['cat'] = $this->Base_model->getOtion(1, "", -1, "");
            $this->load->view('admin/base/header', $dat);
            $this->load->view('admin/' . $this->Component . '/Edit', $dat);
            $this->load->view('admin/base/footer');
        }
    }

    public function editItem($id) {
        //var_dump($this->ajax);die();
        $isAdd = $this->input->post('Title', true);
        if ($isAdd) {
            $this->updateAndInsert();
            if (!$this->ajax) {
                //header("Location: /fasadm/{$this->Component}/");
            }
        } else {
            $this->Load_model->delWithout();
            $dat['com'] = $this->user_model->getComp();
            $dat['Seo'] = $this->Seo_model->get_List(array("count" => 1, "Url" => "/{$this->Component}/item/" . $id . "/"));
            $dat['current']['mas'] = $this->CurrentModel->get_List(array("count" => 1, "id" => $id));
            $dat['current']['type'] = "edit";
            $dat['current']['id'] = $id;
            $dat['current']['action'] = "/fasadm/{$this->Component}/edit/{$id}/";
            $dat['current']['image'] = $this->Load_model->getPhotos(array("Type" => "item", "Item_id" => $id, "count" => 100));
            $dat['current']['itemFasad'] = $this->Load_model->getPhotos(array("Type" => "itemFasad", "Item_id" => $id, "count" => 100), "itemFasad");
            $dat['current']['itemColor'] = $this->Load_model->getPhotos(array("Type" => "itemColor", "Item_id" => $id, "count" => 100), "itemColor");
            $dat['current']['rigthPhoto'] = $this->Load_model->getPhotos(array("Type" => "rigthPhoto", "Item_id" => $id, "count" => 100), "rigthPhoto");
            $dat['current']['cat'] = $this->Base_model->getOtion(1, "", $this->getFirstCat($dat['current']['mas']['Cat']), "");
            //echo "<pre>";
            //var_dump($dat);die();
            $this->load->view('admin/base/header', $dat);
            $this->load->view('admin/' . $this->Component . '/Edit', $dat);
            $this->load->view('admin/base/footer');
        }
    }

    public function delitItem($id) {
        $this->CurrentModel->delete($id);
        header("Location: /fasadm/{$this->Component}/");
    }

    public function addCat() {
        $mas = ($this->input->post(null, true));
        $this->list_model->saveCat($mas, array('Title', 'Link', 'id', 'Parent_id'));
        if (!$this->ajax) {
            header("Location: /fasadm/{$this->Component}/");
        } else {
            $mas1['result'] = "ok";
            $mas1['message'] = "Данные сохранены";
            if (!$this->ajax) {
                $mas1['location'] = "/fasadm/{$this->Component}/";
            }
            echo json_encode($mas1);
        }
        //echo "ok";
    }

    private function getFirstCat($cat) {
        $catArray = explode(",", trim($cat, ","));
        return $catArray[0];
    }

    public function updateAndInsert() {
        $mas = ($this->input->post(null, false));
        $existDubl = false;
        if ($mas['EnglishTitle'] === $mas['LastTitle']) {
            $existDubl = true;
        } else {
            $exist = $this->CurrentModel->get_List(array("count" => 1, "EnglishTitle" => $mas['EnglishTitle']));
            if (!$exist) {
                $existDubl = true;
            }
        }
        if ($existDubl) {
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
            $this->addPhoto($mas, "id_photo", "item", $id);
            $this->addPhoto($mas, "itemFasad", "itemFasad", $id);
            $this->addPhoto($mas, "itemColor", "itemColor", $id);
            $this->addPhoto($mas, "rigthPhoto", "rigthPhoto", $id, true);
            $mas["Url"] = "/{$this->Component}/item/" . $id . "/";
            $mas["Psevdonime"] = "/Catalog/item/" . $mas["EnglishTitle"] . "/";
            $this->Seo_model->insert($mas);
            $mas1['result'] = "ok";
            $mas1['message'] = "Данные сохранены";
            if (!$this->ajax) {
                $mas1['location'] = "/fasadm/{$this->Component}/";
            }
        } else {
            $mas1['result'] = "error";
            $mas1['message'] = "Название уже используеться";
        }
        echo json_encode($mas1);
        //var_dump($id);die();
    }

    private function addPhoto($mas, $index, $type, $id, $onliOne = false) {
        $edit["Type"] = $type;
        $edit["Item_id"] = $id;
        if (isset($mas[$index])) {
            foreach ($mas[$index] as $k => $v) {
                $edit["Order"] = $k;
                $this->Load_model->update($edit, $v);
                if ($onliOne)
                    $edit["Type"] = "";
            }
        }
    }

}
