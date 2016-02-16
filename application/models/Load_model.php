<?php

class Load_model extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    private $table = "Photo";

    public function get_List($mas = "") {
        $config = array(
            'Type' => FALSE, //тип
            'Item_id' => FALSE, //
            'name' => FALSE, //name
            'count' => 8, //count enement in one page
            'current' => 0, //current element
            'id' => FALSE
        );
        if (isset($mas['current']) && (!is_numeric($mas['current']) || $mas['current'] > 10000)) {
            unset($mas['current']);
        }
        $config = array_merge($config, (array) $mas);

        if ($config['Type'] !== FALSE) {
            $this->db->where('`Type`', $config['Type']);
        }

        if ($config['Item_id'] !== FALSE) {
            $this->db->where('`Item_id`', $config['Item_id']);
        }

        if ($config['name'] !== FALSE) {
            $this->db->where('`Name`', $config['name']);
        }

        if ($config['id'] != FALSE) {
            $this->db->where('`id`', $config['id']);
        }
        $this->db->order_by('Order', 'ASC');
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

        return $this->db->count_all_results($this->table);
    }

    public function delWithout() {
        $delPhoto = $this->get_List(array("Type" => "", "count" => 30));
        //var_dump($this->db->last_query());
        foreach ($delPhoto as $v) {
            $this->delete($v['id']);
        }
    }

    public function insert($mas) {
        $mas = $this->clearForCatalog($mas);
        //var_dump($mas);die();
        $this->db->insert($this->table, $mas);
    }

    public function update($mas, $id) {
        $mas = $this->clearForCatalog($mas);
        $this->db->update($this->table, $mas, array('id' => $id));
    }

    public function delete($id) {
        $delPhoto = $this->get_List(array("id" => $id, "count" => 1));
        if (file_exists(BASE . $delPhoto['Puth'] . "/small/" . $delPhoto['Name'])) {
            unlink(BASE . $delPhoto['Puth'] . "/small/" . $delPhoto['Name']);
        }
        if (file_exists(BASE . $delPhoto['Puth'] . "/big/" . $delPhoto['Name'])) {
            unlink(BASE . $delPhoto['Puth'] . "/big/" . $delPhoto['Name']);
        }
        // var_dump($delPhoto);die();
        $this->db->delete($this->table, array('id' => $id));
    }

    private function clearForCatalog($mas) {
        $clearArray = array("Title", "Type", "Price", "Description", "Puth", "Name", "Item_id", "Order");
        foreach ($mas as $k => $v) {
            if (!in_array($k, $clearArray)) {
                unset($mas[$k]);
            }
        }
        return $mas;
    }

    public function getPhotos($mas, $vid = "id_photo") {
        (array) $allPhoto = $this->Load_model->get_List($mas);
        //var_dump($allPhoto);
        //die();
        if (isset($mas['count']) && $mas['count'] == 1) {
            return $this->getVerstka($allPhoto, $vid);
        }
        $stringPhotos = "";
        foreach ($allPhoto as $v) {
            $stringPhotos .= $this->getVerstka($v, $vid);
        }
        return $stringPhotos;
    }

    private function getVerstka($mas, $vid) {
        return '
            <li>
                <div class="delPhotoCont">
                    <label class="delPhoto">
                        <input type="checkbox" name="del[]" value="' . $mas['id'] . '">
                    </label>
                </div>
                <div class="img" style="background-image: url(' . $mas['Puth'] . 'small/' . $mas['Name'] . ');"></div>
                <div class="data">
                    <input type="hidden" name="' . $vid . '[]" value="' . $mas['id'] . '">
                </div>
            </li>
         ';
    }

}
