<?php

class User_model extends CI_Model {

    public function __construct() {
        $this->load->database();
        $this->load->library('session');
        $this->load->library('show');
        $this->load->helper('url');
        $this->load->model('Base_model');
        $this->CurrentModel = $this->Base_model;
        
    }

    public function get_avtor($login = FALSE, $password = False) {
        if ($login != FALSE && $password != FALSE) {//9e7e1b85c49f8c5ab1b83fab4143ae17
            $this->CurrentModel->set_table("Admin");
            $user = $this->CurrentModel->get_List(array("count" => 1, "Email" => $login));
            if (!$user)
                return false;
            $password = md5($password . $this->config->config['encryption_key'] . $user['isAdmin']);
            $this->db->where('`Email`', $login);
            $this->db->where('`Password`', $password);
            $cou = $this->db->count_all_results('Admin');
            if ($cou == 1) {
                $this->db->where('`Email`', $login);
                $this->db->where('`Password`', $password);
                $query = $this->db->get('Admin', 1, 0);
                return $query->row_array();
            }
        }
        return false;
    }

    public function isAvtoris() {
        if ($_SERVER['REQUEST_URI'] !== "/fasadm/" && $_SERVER['REQUEST_URI'] !== "/fasadm/avtoris/") {
            if (!$this->session->has_userdata('user_id')) {
                header("Location: /fasadm/");
            } else {
                $is_premission = in_array($this->router->fetch_class(), $this->session->premission);
                if (!$is_premission) {
                    if ($this->session->is_admin != 1) {
                        header("Location: /fasadm/");
                    }
                }
            }
        }
    }

    public function getComp() {
        if ($this->session->is_admin === 1) {
            $this->db->where('`Show`', 0);
        }
        $this->db->order_by('Order', 'ASC');
        $query = $this->db->get('Component', 130, 0);
        $component = $query->result_array();
        $componetnArray['Crumbs'] = '<li><a href="/fasadm/"><i class="fa fa-dashboard"></i>Корень</a></li>';
        $componetnArray['Name'] = '';
        foreach ($component as $k => &$v) {
            if (!in_array($v['Name'], $this->session->premission)) {
                if ($this->session->is_admin != 1) {
                    unset($component[$k]);
                    continue;
                }
            }
            if ($v['Name'] == $this->router->fetch_class()) {
                $v['Act'] = "active";
                $componetnArray['Crumbs'] .= '<li><a href="' . $v['Puth'] . '"><i class="fa ' . $v['Icon'] . '"></i>' . $v['Title'] . '</a></li>';
                $componetnArray['Name'] = $v['Title'];
            } else {
                $v['Act'] = "";
            }
        }
        //die();
        $componetnArray['Items'] = $component;
        return $componetnArray;
    } 

}
