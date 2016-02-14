<?php

class Catalog extends CI_Controller {

    private $menu = "";
    private $cat = "";

    public function __construct() {
        parent::__construct();
        $this->load->model('Catalog_model');
        $this->load->model('list_model');
        $this->load->model('Load_model');
        $this->load->model('Seo_model');
        $this->load->library('pagin');
        $List11 = $this->list_model->get_List(array("Parent_id" => 13, "count" => 100));
        $cat = $this->list_model->get_List(array("Parent_id" => 1, "count" => 100));
        $this->menu = $this->list_model->menuCat($List11, array(array("link" => "/catalog/", "list" => $cat, "id" => 14)), "", "");
        $this->cat = $cat;
    }

    public function index($cat1 = false, $cat2 = false) {
        //var_dump($cat1,$cat2);die();
        $dat['menu'] = $this->menu;
        $dat['cat'] = $this->getMenuCat($this->cat, $cat1, "");
        $page = $this->input->get('page', true);
        $config['total_rows'] = $this->Catalog_model->get_count(array('cid' => array($cat1, $cat2)));
        $config['base_url'] = "";
        $config['cur_page'] = $page;
        $config['page_size'] = 3;
        $this->pagin->initialize($config);
        $dat['pagin'] = $this->pagin->getLinks();
        $catalogList = $this->Catalog_model->get_List(array("current" => $page, "count" => $config['page_size'], 'cid' => array($cat1, $cat2)));
        $dat["catList"] = $this->madeTrueArray($catalogList);
        $dat["Crumbs"] = $this->getCrumbs(array($cat1, $cat2));
        //var_dump($dat["catList"]);
        $this->load->view('site/base/header', $dat);
        $this->load->view('site/catalog/list', $dat);
        $this->load->view('site/catalog/catalog', $dat);
        $this->load->view('site/catalog/listEnd', $dat);
        $this->load->view('site/base/footer');
    }

    public function item($id) {
        $dat['menu'] = $this->menu;
        $catalogItem = $this->Catalog_model->get_List(array("count" => 1, 'EnglishTitle' => $id));
        if (!$catalogItem){
            header("Location: /catalog/");
        }
        $dat['item'] = $this->madeTrueArrayForItem($catalogItem);
        
        $dat["Crumbs"] = $this->getCrumbs(explode(",", trim($dat['item']['Cat'], ",")));
        $this->load->view('site/base/header', $dat);
        $this->load->view('site/catalog/item', $dat);
        $this->load->view('site/base/footer');
    }

    public function getInfo($id) {
        $catalogList = $this->Catalog_model->get_List(array("count" => 1, 'id' => $id));
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
    
    private function getCrumbs($mas1){
        //echo "<pre>";
        $mas["Title"] = "Каталог";
        $mas['Crumbs'] = "<ul class='grayline-list'>
            <li><a href='/'>Главная</a></li>
            <li class='sep'>/</li>
            <li><a href='/catalog/'>Каталог</a></li>";
        $beforeLisnk = "/catalog/";
        foreach (array_reverse($mas1) as $v) {
            if ($v && $v != 1){
                $currentList = $this->list_model->get_List(array("idLink" => $v, "count" => 1));
                //var_dump($currentList);
                if ($currentList){
                    $mas['Crumbs'] .= "<li class='sep'>/</li>
                        <li><a href='{$beforeLisnk}{$currentList['Link']}/'>{$currentList['Title']}</a></li>";
                    $mas["Title"] = $currentList['Title'];
                    $beforeLisnk = "{$beforeLisnk}{$currentList['Link']}/";
                }
            }           
        }
        //var_dump($mas1);
        //var_dump($mas['Crumbs']);
        //die();
        $mas['Crumbs'] .= "</ul>";
        return $mas;
    }

    private function getMenuCat($list, $act, $str) {
        $str .= '<ul class="sidemenu">';
        foreach ($list as $v) {
            $active = "";
            $style = "";
            if ($v['Link'] === $act) {
                $active = "active";
                $style = "style='display: block;'";
            }
            $str .= '<li class="sidemenu__item ' . $active . '">
                        <a href="/catalog/' . $v['Link'] . '/" class="sidemenu__item-link"><span>' . $v['Title'] . '</span></a>';
            $List11 = $this->list_model->get_List(array("Parent_id" => $v['id'], "count" => 100));
            if ($List11) {
                $str .=
                        '<div class="sidemenu__item-count">' . count($List11) . '</div>
                            <div class="sidemenu__item-dropbox" ' . $style . '>
                                <ul>';
                foreach ($List11 as $v1) {
                    $str.='<li><a href="/catalog/' . $v['Link'] . '/' . $v1['Link'] . '/"><span>' . $v1['Title'] . '<span></a></li>';
                }
                $str .= '</ul>';
            }

            $str .= '</li>';
        }
        $str .= '</ul>';
        return $str;
    }

}
