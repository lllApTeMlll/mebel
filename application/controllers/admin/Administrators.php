<?php

class Administrators extends CI_Controller {

    private $Component = "Administrators";

    public function __construct() {
        parent::__construct();
        $this->load->model('user_model');
        $this->load->library('pagin');
        $this->load->library('show');
        $this->load->library('session');
        $this->load->model('Base_model');
        $this->load->library('session');
        $this->CurrentModel = $this->Base_model;
        $this->CurrentModel->set_table("Admin");
        $this->CurrentModel->set_white(array("Email", "Password", "Privilege"));
        $this->load->helper('text');
        $this->user_model->isAvtoris();
        $this->ajax = $this->input->post('type', true) === "ajax" ? true : false;
    }

    public function index() {
        $this->Base_model->set_table("Admin");
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
        $this->Base_model->set_table("Admin");
        $isAdd = $this->input->post('Email', true);
        if ($isAdd) {
            $this->updateAndInsert();
            //header("Location: /fasadm/{$this->Component}/");
        } else {
            $dat['com'] = $this->user_model->getComp();
            $dat['current']['mas'] = array("Email" => "", "Password" => "", "Url" => "");
            $dat['current']['type'] = "add";
            $dat['current']['id'] = "";
            $dat['current']['com'] = $this->getCompAdmin(array());
            $dat['current']['action'] = "/fasadm/{$this->Component}/add/";
            $this->load->view('admin/base/header', $dat);
            $this->load->view('admin/' . $this->Component . '/Edit', $dat);
            $this->load->view('admin/base/footer');
        }
    }

    public function editItem($id) {
        //var_dump(phpinfo());die();
        $this->Base_model->set_table("Admin");
        $isAdd = $this->input->post('Email', true);
        if ($isAdd) {
            $this->updateAndInsert();
            if (!$this->ajax) {
                //header("Location: /fasadm/{$this->Component}/");
            }
        } else {
            $dat['com'] = $this->user_model->getComp();
            $dat['current']['mas'] = $this->CurrentModel->get_List(array("count" => 1, "id" => $id));
            $dat['current']['type'] = "edit";
            $dat['current']['id'] = $id;
            $premission = json_decode($dat['current']['mas']['Privilege']) ? json_decode($dat['current']['mas']['Privilege']) : $dat['current']['mas']['Privilege'];
            $dat['current']['com'] = $this->getCompAdmin($premission);
            //$this->show->show1($dat['current']['com']);
            $dat['current']['action'] = "/fasadm/{$this->Component}/edit/{$id}/";
            $this->load->view('admin/base/header', $dat);
            $this->load->view('admin/' . $this->Component . '/Edit', $dat);
            $this->load->view('admin/base/footer');
        }
    }

    public function delitItem($id) {
        $this->Base_model->set_table("Admin");
        $user = $this->CurrentModel->get_List(array("count" => 1, "id" => $id));
        if ($user['isAdmin'] == 1 && $this->session->is_admin != 1) {
            $mas1['result'] = "error";
            $mas1['message'] = "Нет доступа";
            echo json_encode($mas1);
        } else {
            $this->CurrentModel->delete($id);
            header("Location: /fasadm/{$this->Component}/");
        }
    }

    private function updateAndInsert() {
        $this->Base_model->set_table("Admin");
        $mas = ($this->input->post(null, true));
        $existDubl = false;
        if ($mas['Email'] === $mas['LastEmail']) {
            $existDubl = true;
        } else {
            $exist = $this->CurrentModel->get_List(array("count" => 1, "Email" => $mas['Email']));
            if (!$exist) {
                $existDubl = true;
            }
        }
        if ($existDubl) {

            $mas["Privilege"] = json_encode($mas["Privilege"]);
            $id = $this->input->post('id', true);
            $type = $this->input->post('type', true);
            if ($type !== 'add') {
                $user = $this->CurrentModel->get_List(array("count" => 1, "id" => $id));
            }
            //$this->show->show1($user,true);
            if ($user['isAdmin'] == 1 && $this->session->is_admin != 1) {
                $mas1['result'] = "error";
                $mas1['message'] = "Нет доступа";
            } else {
                if ($type == 'add') {
                    $mas["Password"] = md5($mas["Password"] . $this->config->config['encryption_key'] . "0");
                    $id = $this->CurrentModel->insert($mas);
                } else {
                    if ($mas["Password"] === "") {
                        unset($mas["Password"]);
                    } else {
                        $mas["Password"] = md5($mas["Password"] . $this->config->config['encryption_key'] . $user['isAdmin']);
                    }
                    $this->CurrentModel->update($mas, $id);
                }
                $mas1['result'] = "ok";
                $mas1['message'] = "Данные сохранены";
                if (!$this->ajax) {
                    $mas1['location'] = "/fasadm/{$this->Component}/";
                }
            }
        } else {
            $mas1['result'] = "error";
            $mas1['message'] = "Email уже занят";
        }
        echo json_encode($mas1);
    }

    private function getCompAdmin($premission) {
        $this->Base_model->set_table("Component");
        $comp = $this->CurrentModel->get_List(array("Show" => 0, "count" => 130));
        foreach ($comp as $k => $v) {
            if ($premission === "*") {
                $comp[$k]['active'] = "checked";
            } else {
                if (in_array($v['Name'], $premission)) {
                    $comp[$k]['active'] = "checked";
                } else {
                    $comp[$k]['active'] = "";
                }
            }
        }
        return $comp;
    }

}
