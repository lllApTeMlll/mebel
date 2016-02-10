<?php

class list_model extends CI_Model {

    //private $type;
    private $typeId;
    private $maxDeep;
    private $selectCat;
    private $table = "Cat";

    function __construct($id = 0, $deep = 1) {
        $this->maxDeep = $deep;
        $this->typeId = $id;
        $this->load->database();
    }

    function setId($id) {
        $this->typeId = $id;
    }

    function setmaxDee($maxDee) {
        $this->maxDeep = $maxDee;
    }

    function setselectCat($selectCat) {
        $this->selectCat = $selectCat;
    }

    public function get_ItemsEl($mas = "") {
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

    private function clearWhite($mas) {
        $clearArray = array("Title", "Link", "Parent_id", "id", "Order");
        foreach ($mas as $k => $v) {
            if (!in_array($k, $clearArray)) {
                unset($mas[$k]);
            }
        }
        return $mas;
    }

    public function get_Items($templ = "catList", $idd = 'nestable3', $type = 0, $lemit = 10) {

        $mas = $this->get_ItemsEl(array("id" => $this->typeId));
        require ENGINE . 'admin/List/Templates/' . $templ . '.php';
        //var_dump($masT);
        $st = "<div class='mainForm'>
                <div class='grup list'>
                    <div class='dd' id='{$idd}'>" . $this->getCat($mas, "", $this->typeId, 1, $masT, $type, $lemit) . "</div>"
                . "</div>
                </div>
                <input type='hidden' name='root' value='{$this->typeId}'>";
        $css = "<style>" . file_get_contents(BASE . "/files/site/all/nestable/style.css") . "</style>";
        $js = "<script>" . file_get_contents(BASE . "/files/site/all/nestable/script.js") . "</script>";
        $script = '<script>$(function (){$("#' . $idd . '").nestable({group: 0, maxDepth: ' . $this->maxDeep . ', });});' . jsPast() . '</script>';
        $st.=$css . $js . $script;
        return $st;
    }

    private function getCat($mas, $st, $par, $deep, $temp, $type, $lemit) {
        //$Zupr = new IC_Zapr_Class();
        //$func = new IC_Func_Class();
        if ($deep == 1) {
            $st.=$temp['start'];
        } else {
            $st.=$temp['start1'];
        }
        foreach ($mas as $k => $v) {
            //$ma = $Zupr->selectElAll("`cat`", " WHERE parent_id={$v['id']}  ORDER BY  `order` ASC  ", 0, 100);
            $ma = $this->get_ItemsEl(array("Parent_id" => $v['id'], "count" => 100));
            if ($ma && $deep <= $lemit) {
                $deep1 = $deep;
                $deep1++;
                $varr = $this->getCat($ma, "", $v['id'], $deep1, $temp, $type, $lemit);
            } else {
                $varr = "";
            }
            $par1 = "";
            if ($deep == 1) {
                $par1 = first($v);
            } else {
                if ($deep == $this->maxDeep) {
                    $par1 = last($v);
                } else {
                    $par1 = norm($v);
                }
            }
            $st.="<li class='dd-item dd3-item' data-id='{$v['id']}'>
                    {$par1}
                    {$varr}
                </li>";
        }
        if ($deep == 1) {
            $st.=$temp['end'];
        } else {
            $st.=$temp['end1'];
        }
        return $st;
    }

    public function saveCat($mas, $el) {
        $this->delRoot($mas['root']); //die();
        foreach ($mas['Title'] as $k => $v) {
            if ($v != '') {
                unset($edit);
                $edit['Order'] = $k;
                foreach ($el as $v1) {
                    if (isset($mas[$v1][$k]) && !empty($mas[$v1][$k])) {
                        $edit[$v1] = $mas[$v1][$k];
                    }
                }
                $this->insert($edit);
            }
        }
    }

    public function delRoot($id) {
        $ma = $this->get_ItemsEl(array("Parent_id" => $id, "count" => 100));
        if ($ma) {
            foreach ($ma as $k => $v) {
                $this->delRoot($v['id']);
                $this->delete($v['id']);
            }
        }
    }

    public function menuCat($list, $mas, $str, $drop) {
        //$str.="<ul {$drop}>";
        foreach ($list as $k => $v) {
            $class = "";
            $classA = "";
            $List11 = $this->get_ItemsEl(array("Parent_id" => $v['id'], "count" => 100));
            $podMas = $this->isMas($mas, $v['id']);
            if ($podMas || $List11) {
                $class = "class='dropdown'";
                $classA = "class='nav__item-link-dropdown'";
            }
            $str.="<div class='nav-item-wrap'><div class='nav__item {$class}'>";
            $str.="<a href='' class='nav__item-link {$classA}'>{$v['Title']}</a>";
            if ($podMas) {
                $str.="<div class='nav__item-dropdown'><ul>";
                foreach ($podMas['list'] as $k1 => $v1) {
                    $str.="<li>";
                    $str.="<a href='{$podMas['link']}{$v1['Link']}/'>{$v1['Title']}</a>";
                    $str.="</li>";
                }
                $str.="</ul></div>";
            }
            if ($List11) {
                $str.="<div class='nav__item-dropdown'><ul>";
                foreach ($List11 as $k1 => $v1) {
                    $str.="<li>";
                    $str.="<a href='{$v1['Link']}'>{$v1['Title']}</a>";
                    $str.="</li>";
                }
                $str.="</ul></div>";
            }
            $str.="</div></div>";
        }
        //$str.="</ul>";
        return $str;
    }

    private function isMas($mas, $id) {
        //echo "<pre>";
        foreach ($mas as $k => $v) {
            //var_dump($v);die();
            if ($v['id'] == $id) {
                return $v;
            }
        }
        return false;
    }

    private function getSel($mas) {
//        $Zupr = new IC_Zapr_Class();
//        $ma = $Zupr->selectElAll("`sliders`", " WHERE cid LIKE '%,{$this->selectCat},%'  ORDER BY  `order` ASC  ", 0, 10000);
//        $mas['select'] = $this->getCatOp($ma, array($mas['id_photo']));
//        return $mas;
    }

    private function getCatOp($mas, $act) {
//        $str = "";
//        foreach ($mas as $k => $v) {
//            $sel = "";
//            if (in_array($v['id'], $act))
//                $sel = "selected";
//            $str.="<option {$sel} value='{$v['id']}'>{$v["name"]}</option>";
//        }
//        return $str;
    }

}
