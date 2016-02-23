<?php

class Base_model extends CI_Model {

    private $table;
    private $white = array("Title", "Description");

    function __construct($table = "Cat") {
        $this->load->database();
        $this->table = $table;
        $this->load->model('list_model');
    }

    function set_table($table) {
        $this->table = $table;
    }

    function set_white($white) {
        $this->white = $white;
    }

    public function get_List($mas = "") {
        $config = array(
            'Parent_id' => FALSE, //тип
            'count' => 80, //count enement in one page
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

    public function get_ListV() {
        $query = $this->db->get($this->table, 0, 80);
        $vstavka = $query->result_array();
        foreach ($vstavka as $k => $v) {
            $pattern = '/(?<=\<p\>)(.*)(?=<\/p>)/';
            preg_match($pattern, $v['Description'], $matches);
            if (isset($matches[1]))
                $vstavka[$k]['Description'] = $matches[1];
        }
        return $vstavka;
    }

    public function get_count($mas = "") {
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

        return $this->db->count_all_results($this->table);
    }

    public function insert($mas) {
        $this->db->trans_start();
        $mas = $this->clearWhite($mas);
        //var_dump($mas);die();
        $this->db->insert($this->table, $mas);
        $insert_id = $this->db->insert_id();
        $this->db->trans_complete();
        return $insert_id;
    }

    public function update($mas, $id) {
        $mas = $this->clearWhite($mas);
        $this->db->update($this->table, $mas, array('id' => $id));
    }

    public function delete($id) {
        $this->db->delete($this->table, array('id' => $id));
    }

    public function getRightName($cat) {
        foreach ($cat as $k => $v1) {
            $mas1 = array_reverse(explode(",", trim($v1['Cat'], ",")));
            $str = "";
            foreach (($mas1) as $v) {
                if ($v && $v !== '1') {
                    $currentList = $this->list_model->get_List(array("idLink" => $v, "count" => 1, "Parent_id_NOT" => 0));
                    if ($currentList) {
                        $str .= $currentList['Title'] . ",";
                    }
                }
            }
            $cat[$k]['Cat'] = trim($str, ",");
        }
        return $cat;
    }

    public function getOtion($id, $str, $act, $poast) {
        $allCid = $this->get_List(array("Parent_id" => $id, "count" => 100));
        if ($allCid) {
            foreach ($allCid as $k => $v) {
                $sele = "";
                if ($v['id'] == $act) {
                    $sele = "selected";
                }
                $str.="<option {$sele} value='{$v['id']}'>{$poast}{$v['Title']}</option>";
                $pod = $poast;
                $pod .= "---";
                $str = $this->getOtion($v['id'], $str, $act, $pod);
            }
        }
        return $str;
    }
    
    public function getRightNameForArray($cat,$array) {
        foreach ($cat as $k => $v) {
            $str = "";
            foreach (($array) as $v1) { 
                if ($v['Cat'] == $v1['id']) {
                    $str .= $v1['Title'] . ",";
                    break;
                }
            }
            $cat[$k]['Cat'] = trim($str, ",");
        }
        return $cat;
    }

    public function getOtionForArray($array, $str, $act) {
        if ($array) {
            foreach ($array as $k => $v) {
                $sele = "";
                if ($v['id'] == $act) {
                    $sele = "selected";
                }
                $str.="<option {$sele} value='{$v['id']}'>{$v['Title']}</option>";
            }
        }
        return $str;
    }

    private function clearWhite($mas) {
        //$clearArray = array("Title", "Link", "Parent_id", "id", "Order");
        foreach ($mas as $k => $v) {
            if (!in_array($k, $this->white)) {
                unset($mas[$k]);
            }
        }
        return $mas;
    }

}
