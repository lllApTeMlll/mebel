<?php

class Admin extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('user_model');
        $this->load->library('pagin');
        $this->load->library('show');
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
                'is_admin' => $dat['isAdmin'],
                'premission' => json_decode($dat['Privilege']) ? json_decode($dat['Privilege']) : $dat['Privilege']
            );
            //$this->show->show1($newdata, true);
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

}
