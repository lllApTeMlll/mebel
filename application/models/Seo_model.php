<?php

class Seo_model extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    private $table = "Seo";

    public function get_list($mas = "") {
        $config = array(
            'Url' => FALSE, //тип
            'count' => 8, //count enement in one page
            'current' => 0, //current element
            'id' => FALSE
        );
        if (isset($mas['current']) && (!is_numeric($mas['current']) || $mas['current'] > 10000)) {
            unset($mas['current']);
        }
        $config = array_merge($config, (array) $mas);

        if ($config['Url'] !== FALSE) {
            $this->db->where('`Url`', $config['Url']);
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
        $mas = $this->clearForCatalog($mas);
        $alrwdy = $this->get_list(array("Url" => $mas["Url"],"count" => 1));
        //var_dump(count($alrwdy)==0);die();
        if (count($alrwdy)==0){
            $this->db->insert($this->table, $mas);
        }else{
            $this->db->update($this->table, $mas, array('id' => $alrwdy["id"]));
        }
        
    }

    public function update($mas, $id) {
        $mas = $this->clearForCatalog($mas);
        $this->db->update($this->table, $mas, array('id' => $id));
    }

    public function delete($id) {
        $this->db->delete($this->table, array('id' => $id));
    }

    private function clearForCatalog($mas) {
        $clearArray = array("SeoTitle", "SeoDescription", "SeoKeyword", "Url", "Psevdonime");
        foreach ($mas as $k => $v) {
            if (!in_array($k, $clearArray)) {
                unset($mas[$k]);
            }
        }
        return $mas;
    }

    

}
