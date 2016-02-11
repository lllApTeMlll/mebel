<?php

class Catalog_model extends CI_Model {

    public function __construct() {
        $this->load->database();
        $this->load->model('list_model');
    }
    
    private $table = "Catalog";

    public function get_Catalog($mas = "") {
        $config = array(
            'type' => FALSE, //тип
            'cid' => FALSE, //категория
            'count' => 8, //count enement in one page
            'current' => 0, //current element
            'id' => FALSE
        );
        if (isset($mas['current']) && (!is_numeric($mas['current']) || $mas['current'] > 10000)) {
            unset($mas['current']);
        }
        $config = array_merge($config, (array) $mas);

        if ($config['cid'] != FALSE) {
            $idn = $this->getIdCid($config['cid']);
            //var_dump($idn);die();
            if (!empty($idn)) {
                $this->db->group_start();
                foreach ($idn as $k => $v) {
                    $this->db->or_like('`cid`', "," . $v['id'] . ",");
                }
                $this->db->group_end();
            }
        }
        if ($config['id'] != FALSE) {
            $this->db->where('`id`', $config['id']);
        }
        $query = $this->db->get($this->table, $config['count'], $config['current']);
        if ($config['count'] == 1) {
            return $query->row_array();
        } else
            return $query->result_array();
    }

    public function get_count($mas = "") {
        $config = array(
            'type' => FALSE, //тип
            'cid' => FALSE, //категория
            'count' => 8, //count enement in one page
            'current' => 0, //current element
        );
        if (isset($mas['current']) && (!is_numeric($mas['current']) || $mas['current'] > 10000)) {
            unset($mas['current']);
        }
        $config = array_merge($config, (array) $mas);

        if ($config['cid'] != FALSE) {
            $idn = $this->getIdCid($config['cid']);
            //var_dump($idn);die();
            if (!empty($idn)) {
                $this->db->group_start();
                foreach ($idn as $k => $v) {
                    $this->db->or_like('`cid`', "," . $v['id'] . ",");
                }
                $this->db->group_end();
            }
        }
        return $this->db->count_all_results($this->table);
    }

    public function insert($mas) {
        $this->db->trans_start();
        $mas = $this->clearForCatalog($mas);
        $mas['Cat'] = $this->getAllCat($mas['Cat']);
        //var_dump($mas);die();
        $this->db->insert($this->table, $mas);
        $insert_id = $this->db->insert_id();
        $this->db->trans_complete();
        return $insert_id;
    }

    public function update($mas, $id) {
        $mas = $this->clearForCatalog($mas);
        $mas['Cat'] = $this->getAllCat($mas['Cat']);
        $this->db->update($this->table, $mas, array('id' => $id));
    }

    public function delete($id) {
        $this->db->delete($this->table, array('id' => $id));
    }

    private function clearForCatalog($mas) {
        $clearArray = array("Title", "Articl", "Price", "Description", "Sostav", "EnglishTitle", "Cat");
        foreach ($mas as $k => $v) {
            if (!in_array($k, $clearArray)) {
                unset($mas[$k]);
            }
        }
        return $mas;
    }
    
    private function getAllCat($id,$str){
        $str .= $id.",";
        $parrent = $this->list_model->get_ItemsEl(array("id" => $id, "count" => 1));
        if ($parrent) $str = $this->getAllCat($parrent['id'],$str);
        return $str;
    }

}
