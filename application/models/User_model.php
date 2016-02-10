<?php

class User_model extends CI_Model {

    public function __construct() {
        $this->load->database();
        $this->load->library('session');
        $this->load->helper('url');
    }

    public function get_avtor($login = FALSE, $password = False) {
        if ($login != FALSE && $password != FALSE) {//9e7e1b85c49f8c5ab1b83fab4143ae17
            $password = md5($password . $this->config->config['encryption_key']);
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
        if (!$this->session->has_userdata('user_id')) {
			//echo $_SERVER['REQUEST_URI'];die();
			if ($_SERVER['REQUEST_URI'] !== "/fasadm/"){
				header("/fasadm/");
			}
        }
        //echo $this->router->fetch_class();
    }

    public function getComp() {
        $query = $this->db->get('Component', 130, 0);
        $component = $query->result_array();
        $componetnArray['Crumbs'] = '<li><a href="/fasadm/"><i class="fa fa-dashboard"></i>Корень</a></li>';
        $componetnArray['Name'] = '';
        foreach ($component as &$v) {
            //echo "<pre>";
            //var_dump($v['Name'] == $this->router->fetch_class());
            //var_dump($v['Name'] ,$this->router->fetch_class());
            if ($v['Name'] == $this->router->fetch_class()){
                $v['Act'] = "active";
                $componetnArray['Crumbs'] .= '<li><a href="'.$v['Puth'].'"><i class="fa '.$v['Icon'].'"></i>'.$v['Title'].'</a></li>';
                $componetnArray['Name'] = $v['Title'];
            }else{
                $v['Act'] = "";
            }
        }
        //die();
        $componetnArray['Items'] = $component;
        return $componetnArray;
    }

    public function getSeoList() {
        $query = $this->db->get('seo', 100, 0);
        return $query->result_array();
    }

    public function getSeoItem($id) {
        $query = $this->db->where('`id`', $id)->get('seo', 1, 0);
        return $query->row_array();
    }

    public function insertSeo($mas) {
        $this->db->insert('seo', $mas);
    }

    public function updateSeo($mas, $id) {
        $this->db->update('seo', $mas, array('id' => $id));
    }

    private function addView($id) {
        $query = $this->db->where('`id`', $id)->get('film1');
        $res = $query->row_array();
        //var_dump($res);die();
        $show = $res['view'];
        $show++;
        $data = array(
            'view' => $show
        );
        //var_dump($show);die();
        $this->db->update('film1', $data, array('id' => $id));
    }

}
