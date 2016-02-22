<?php

class Catalog extends CI_Controller {

    private $menu = "";
    private $cat = "";
    private $Component = "catalog";

    public function __construct() {
        parent::__construct();
        $this->load->model('Catalog_model');
        $this->load->model('list_model');
        $this->load->model('Load_model');
        $this->load->model('Seo_model');
        $this->load->library('pagin');
        $this->load->helper('text');
        $this->ajax = $this->input->post('type', true);
        if (!$this->ajax) {
            $List11 = $this->list_model->get_List(array("Parent_id" => 13, "count" => 100));
            $cat = $this->list_model->get_List(array("Parent_id" => 28, "count" => 100));
            $cat1 = $this->list_model->get_List(array("Parent_id" => 29, "count" => 100));
            $this->menu = $this->list_model->menuCat($List11, array(array("link" => "/catalog/catalog/", "list" => $cat, "id" => 14),
                array("link" => "/catalog/material/", "list" => $cat1, "id" => 22)), "", "");
            $this->cat = $cat;
            $this->cat1 = $cat1;
        }
    }

    public function index($cat = "catalog", $cat1 = false, $cat2 = false) {
        $dat['menu'] = $this->menu;
        $before = "/catalog/catalog/";
        $TiteleFirest = "Каталог";
        if ($cat === "catalog") {
            if (!$this->ajax) {
                $dat['cat'] = $this->getMenuCat($this->cat, $cat1, "", $before);
            }
        } else {
            $before = "/catalog/material/";
            $TiteleFirest = "Материалы";
            if (!$this->ajax) {
                $dat['cat'] = $this->getMenuCat($this->cat1, $cat1, "", $before);
            }
        }
        $page = $this->input->get('page', true);
        $config['total_rows'] = $this->Catalog_model->get_count(array('cid' => array($cat, $cat1, $cat2)));
        $config['base_url'] = "";
        $config['cur_page'] = $page;
        $config['page_size'] = 12;
        $this->pagin->initialize($config);
        $dat['pagin'] = $this->pagin->getLinks();
        $catalogList = $this->Catalog_model->get_List(array("current" => $page, "count" => $config['page_size'], 'cid' => array($cat, $cat1, $cat2)));
        $dat["catList"] = $this->madeTrueArray($catalogList);
        $dat["Crumbs"] = $this->getCrumbs(array($cat1, $cat2), false, $before, $TiteleFirest);
        //var_dump($dat["catList"]);
        if (!$this->ajax) {
            $this->load->view('site/base/header', $dat);
            $this->load->view('site/' . $this->Component . '/list', $dat);
        }
        $this->load->view('site/' . $this->Component . '/catalog', $dat);
        if (!$this->ajax) {
            $this->load->view('site/' . $this->Component . '/listEnd', $dat);
            $this->load->view('site/base/footer');
        }
    }

    public function item($id) {
        $dat['menu'] = $this->menu;
        $catalogItem = $this->Catalog_model->get_List(array("count" => 1, 'EnglishTitle' => $id));
        if (!$catalogItem) {
            header("Location: /{$this->Component}/catalog/");
        }
        $dat['item'] = $this->madeTrueArrayForItem($catalogItem);
        $before = "/catalog/catalog/";
        if (array_reverse(explode(",", trim($dat['item']['Cat'], ",")))[0] == 29) {
            $before = "/catalog/material/";
        }
        $dat["Crumbs"] = $this->getCrumbs(array_reverse(explode(",", trim($dat['item']['Cat'], ","))), true, $before);
        $this->load->view('site/base/header', $dat);
        $this->load->view('site/' . $this->Component . '/item', $dat);
        $this->load->view('site/base/footer');
    }

    public function getInfo($id) {
        $catalogList = $this->Catalog_model->get_List(array("count" => 1, 'id' => $id));
        //$catalogList['Description'] = word_limiter($v['Description'], 50);
        //var_dump($catalogList);die();
        $catList = $this->madeTrueArray(array($catalogList), true);
        $dat['cat'] = $catList[0];
        //var_dump($dat['cat']); die();
        $this->load->view('site/catalog/mini_info', $dat);
    }

    private function madeTrueArray($mas, $array = false) {
        foreach ($mas as $k => $v) {
            $pthoto = $this->Load_model->get_List(array('count' => ($array ? 100 : 1), "Type" => "item", "Item_id" => $v['id']));
            if ($pthoto) {
                $mas[$k]['photo'] = ($array ? $pthoto : $pthoto['Puth'] . "small/" . $pthoto['Name']);
            } else {
                $mas[$k]['photo'] = "";
            }
        }
        return $mas;
    }

    private function madeTrueArrayForItem($mas) {
        $pthoto = $this->Load_model->get_List(array('count' => 100, "Type" => "item", "Item_id" => $mas['id']));
        if ($pthoto) {
            $mas['photo'] = $pthoto;
        } else {
            $mas['photo'] = "";
        }
        $pthoto = $this->Load_model->get_List(array('count' => 100, "Type" => "itemFasad", "Item_id" => $mas['id']));
        if ($pthoto) {
            $mas['itemFasad'] = $pthoto;
        } else {
            $mas['itemFasad'] = "";
        }
        $pthoto = $this->Load_model->get_List(array('count' => 100, "Type" => "itemColor", "Item_id" => $mas['id']));
        if ($pthoto) {
            $mas['itemColor'] = $pthoto;
        } else {
            $mas['itemColor'] = "";
        }
        return $mas;
    }

    private function getCrumbs($mas1, $pr = false, $before = "/catalog/", $TiteleFirest = "Каталог") {
        //echo "<pre>";
        $mas["Title"] = $TiteleFirest;
        $mas['Crumbs'] = "<ul class='grayline-list'>
            <li><a href='/'>Главная</a></li>
            <li class='sep'>/</li>";
        $a = "<li><a href='{$before}'>{$TiteleFirest}</a></li>";
        $last = "<li>{$TiteleFirest}</li>";
        $beforeLisnk = $before;
        foreach (($mas1) as $v) {
            //var_dump($v);
            if ($v && $v !== '1' && $v !== '28' && $v !== '29') {
                $currentList = $this->list_model->get_List(array("idLink" => $v, "count" => 1, "Parent_id_NOT" => 0));
                //var_dump($currentList);
                if ($currentList) {
                    $mas['Crumbs'] .= $a . "<li class='sep'>/</li>";
                    $a = "<li><a href='{$beforeLisnk}{$currentList['Link']}/'>{$currentList['Title']}</a></li>";
                    $last = "<li>{$currentList['Title']}</li>";
                    $mas["Title"] = $currentList['Title'];
                    $beforeLisnk = "{$beforeLisnk}{$currentList['Link']}/";
                }
            }
        }
        $mas['Crumbs'] .= ($pr ? $a : $last);
        //echo "</pre>";
        //var_dump($mas1);
        //var_dump($mas['Crumbs']);
        //die();
        $mas['Crumbs'] .= "</ul>";
        return $mas;
    }

    private function getMenuCat($list, $act, $str, $url) {
        $str .= '<ul class="sidemenu">';
        foreach ($list as $v) {
            $active = "";
            $style = "";
            if ($v['Link'] === $act) {
                $active = "active";
                $style = "style='display: block;'";
            }
            $str .= '<li class="sidemenu__item ' . $active . '">
                        <a href="' . $url . $v['Link'] . '/" class="sidemenu__item-link"><span>' . $v['Title'] . '</span></a>';
            $List11 = $this->list_model->get_List(array("Parent_id" => $v['id'], "count" => 100));
            if ($List11) {
                $str .=
                        '<div class="sidemenu__item-count">' . count($List11) . '</div>
                            <div class="sidemenu__item-dropbox" ' . $style . '>
                                <ul>';
                foreach ($List11 as $v1) {
                    $str.='<li><a href="' . $url . $v['Link'] . '/' . $v1['Link'] . '/"><span>' . $v1['Title'] . '<span></a></li>';
                }
                $str .= '</ul>';
            }

            $str .= '</li>';
        }
        $str .= '</ul>';
        return $str;
    }

}
