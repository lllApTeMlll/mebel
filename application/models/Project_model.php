<?php

class Project_model extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    private $table = "Project";

    public function get_List($mas = "") {
        $config = array(
            'count' => 8, //count enement in one page
            'current' => 0, //current element
            'id' => FALSE,
            'Url' => FALSE,
        );
        if (isset($mas['current']) && (!is_numeric($mas['current']) || $mas['current'] > 10000)) {
            unset($mas['current']);
        }
        $config = array_merge($config, (array) $mas);

        if ($config['id'] !== FALSE) {
            $this->db->where('`id`', $config['id']);
        }

        if ($config['Url'] !== FALSE) {
            $this->db->where('`Url`', $config['Url']);
        }

        $query = $this->db->get($this->table, $config['count'], $config['current']);
        if ($config['count'] == 1) {
            return $query->row_array();
        } else
            return $query->result_array();
    }

    public function get_count($mas = "") {
        $config = array(
            'count' => 8, //count enement in one page
            'current' => 0, //current element
            'id' => FALSE,
            'Url' => FALSE,
        );
        if (isset($mas['current']) && (!is_numeric($mas['current']) || $mas['current'] > 10000)) {
            unset($mas['current']);
        }
        $config = array_merge($config, (array) $mas);

        if ($config['id'] !== FALSE) {
            $this->db->where('`id`', $config['id']);
        }

        if ($config['Url'] !== FALSE) {
            $this->db->where('`Url`', $config['Url']);
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
        $clearArray = array("Title", "Articl", "Review", "Description", "EnglishTitle");
        foreach ($mas as $k => $v) {
            if (!in_array($k, $clearArray)) {
                unset($mas[$k]);
            }
        }
        return $mas;
    }

}
