<?php

class Admin extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('user_model');
        $this->load->library('pagin');
        $this->load->helper('text');
        $this->load->library('session');
        $this->user_model->isAvtoris();
    }

    public function index() {
		//die();
        if ($this->session->has_userdata('user_id')) {
            $dat['com'] = $this->user_model->getComp();
            //$dat['cur'] = $this->getCur();
            $this->load->view('admin/base/header', $dat);
            $this->load->view('admin/dashbord', $dat);
            $this->load->view('admin/base/footer');
        } else {
            $this->load->view('admin/avtoris');
        }
    }

    public function avtoris() {
        $login = $this->input->post('name', true);
        $password = $this->input->post('password', true);
        $dat = $this->user_model->get_avtor($login, $password);
        //var_dump($dat);die();
        if ($dat) {
            $newdata = array(
                'username' => $dat['Email'],
                'user_id' => $dat['id'],
                'premission' => $dat['Privilege']
            );
            $this->session->set_userdata($newdata);
            $mas['result'] = 'ok';
            $mas['mess'] = 'Вы авторизованы';
            echo json_encode($mas);
        } else {
            $mas['result'] = 'no';
            $mas['mess'] = 'Неверные данные';
            echo json_encode($mas);
        }
    }

    public function loggout() {
        if ($this->session->has_userdata('user_id')) {
            $array_items = array('username', 'user_id');
            $this->session->unset_userdata($array_items);
            $mas['result'] = 'ok';
            echo json_encode($mas);
        } else {
            $this->load->view('admin/avtoris');
        }
    }

    public function seo() {
        if ($this->session->has_userdata('user_id')) {
            $dat['com'] = $this->user_model->getComp();
            $dat['cur'] = $this->getCur();
            $this->load->view('templates/headerA', $dat);
            unset($dat);
            $dat['seo'] = $this->user_model->getSeoList();
            $this->load->view('admin/seo/seo', $dat);
            $this->load->view('templates/footerA');
        } else {
            $this->load->view('admin/avtoris');
        }
    }

    public function seo_add() {
        if ($this->session->has_userdata('user_id')) {
            $url = $this->input->post('url', true);
            if ($url) {
                $mas = ($this->input->post(null, true));
                $id = $this->input->post('id', true);
                $type = $this->input->post('type', true);
                unset($mas['id']);
                unset($mas['type']);
                if ($type == 'add') {
                    $this->user_model->insertSeo($mas);
                } else {
                    $this->user_model->updateSeo($mas, $id);
                }
                header("Location: /fasadm/seo/");
            }
            $dat['com'] = $this->user_model->getComp();
            $dat['cur'] = $this->getCur();
            $this->load->view('templates/headerA', $dat);
            unset($dat);
            $dat['type'] = 'add';
            $dat['list'] = array('url' => "", 'h1' => "", 'title' => "", 'kywords' => "", 'description' => "", 'arricl' => "", 'id' => "");
            $this->load->view('admin/seo/seo_item', $dat);
            $this->load->view('templates/footerA');
        } else {
            $this->load->view('admin/avtoris');
        }
    }

    public function seo_edit($id) {
        if ($this->session->has_userdata('user_id')) {
            $dat['com'] = $this->user_model->getComp();
            $dat['cur'] = $this->getCur();
            $this->load->view('templates/headerA', $dat);
            unset($dat);
            $dat['type'] = 'edit';
            $dat['list'] = $this->user_model->getSeoItem($id);
            $this->load->view('admin/seo/seo_item', $dat);
            $this->load->view('templates/footerA');
        } else {
            $this->load->view('admin/avtoris');
        }
    }

    private function getCur() {
        $URI = explode('/', trim($_SERVER['REQUEST_URI'], '/'));
        $cur = "";
        if (isset($URI[1]))
            $cur = $URI[1];
        return $cur;
    }


}
