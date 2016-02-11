<?php

class Base_model extends CI_Model {

    private $table;

    function __construct($table = "Cat") {
        $this->load->database();
        $this->table = $table;
    }

    function set_table($table) {
        $this->table = $table;
    }

    public function get_list($mas = "") {
        $config = array(
            'Parent_id' => FALSE, //тип
            'count' => 8, //count enement in one page
            'current' => 0, //current element
            'id' => FALSE
        );
        if (isset($mas['current']) && (!is_numeric($mas['current']) || $mas['current'] > 10000)) {
            unset($mas['current']);
        }
        $config = array_merge($config, (array) $mas);

        if ($config['id'] !== FALSE) {
            $this->db->where('`id`', $config['id']);
        }
        if ($config['Parent_id'] !== FALSE) {
            $this->db->where('`Parent_id`', $config['Parent_id']);
        }
        
        $this->db->order_by('Order', 'ASC');
        
        $query = $this->db->get($this->table, $config['count'], $config['current']);
        if ($config['count'] == 1) {
            return $query->row_array();
        } else
            return $query->result_array();
    }

    public function insert($mas) {
        //var_dump($mas);
        $mas = $this->clearWhite($mas);
        //var_dump($mas);die();
        $this->db->insert($this->table, $mas);
    }

    public function update($mas, $id) {
        $mas = $this->clearWhite($mas);
        $this->db->update($this->table, $mas, array('id' => $id));
    }

    public function delete($id) {
        $this->db->delete($this->table, array('id' => $id));
    }

    public function getOtion($id, $str, $act, $poast) {
        $allCid = $this->get_list(array("Parent_id" => $id, "count" => 100));
        if ($allCid) {
            foreach ($allCid as $k => $v) {
                $sele = "";
                if ($v['id'] == $act)
                    $sele = "selected";
                $str.="<option {$sele} value='{$v['id']}'>{$poast}{$v['title']}</option>";
                $pod = $poast;
                $pod .= "-";
                $str = $this->getOtion($v['id'], $str, $act, $pod);
            }
        }
        return $str;
    }
    
    private function clearWhite($mas,$white) {
        //$clearArray = array("Title", "Link", "Parent_id", "id", "Order");
        foreach ($mas as $k => $v) {
            if (!in_array($k, $white)) {
                unset($mas[$k]);
            }
        }
        return $mas;
    }
}
