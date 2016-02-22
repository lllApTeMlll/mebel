<?php

class News_model extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    private $table = "News";

    public function get_List($mas = "") {
        $config = array(
            'Cat' => FALSE, //тип
            'count' => 8, //count enement in one page
            'current' => 0, //current element
            'EnglishTitle' => FALSE,
            'id' => FALSE
        );
        if (isset($mas['current']) && (!is_numeric($mas['current']) || $mas['current'] > 10000)) {
            unset($mas['current']);
        }
        $config = array_merge($config, (array) $mas);

        if ($config['id'] !== FALSE) {
            $this->db->where('`id`', $config['id']);
        }
        if ($config['EnglishTitle'] != FALSE) {
            $this->db->where('`EnglishTitle`', $config['EnglishTitle']);
        }
        if ($config['Cat'] !== FALSE) {
            $this->db->where('`Cat`', $config['Cat']);
        }

        $query = $this->db->get($this->table, $config['count'], $config['current']);
        if ($config['count'] == 1) {
            return $query->row_array();
        } else
            return $query->result_array();
    }

    public function get_count($mas = "") {
        $config = array(
            'Cat' => FALSE, //тип
            'count' => 8, //count enement in one page
            'current' => 0, //current element
            'EnglishTitle' => FALSE,
            'id' => FALSE
        );
        if (isset($mas['current']) && (!is_numeric($mas['current']) || $mas['current'] > 10000)) {
            unset($mas['current']);
        }
        $config = array_merge($config, (array) $mas);

        if ($config['id'] !== FALSE) {
            $this->db->where('`id`', $config['id']);
        }
        if ($config['EnglishTitle'] != FALSE) {
            $this->db->where('`EnglishTitle`', $config['EnglishTitle']);
        }
        if ($config['Cat'] !== FALSE) {
            $this->db->where('`Cat`', $config['Cat']);
        }
        return $this->db->count_all_results($this->table);
    }

    public function insert($mas) {
        $this->db->trans_start();
        $mas = $this->clearWhiteList($mas);
        //var_dump($mas);die();
        $this->db->insert($this->table, $mas);
        $insert_id = $this->db->insert_id();
        $this->db->trans_complete();
        return $insert_id;
    }

    public function update($mas, $id) {
        $mas = $this->clearWhiteList($mas);
        $this->db->update($this->table, $mas, array('id' => $id));
    }

    public function delete($id) {
        $this->db->delete($this->table, array('id' => $id));
    }

    private function clearWhiteList($mas) {
        $clearArray = array("Title","Cat", "Date", "Description", "EnglishTitle");
        foreach ($mas as $k => $v) {
            if (!in_array($k, $clearArray)) {
                unset($mas[$k]);
            }
        }
        return $mas;
    }

}
